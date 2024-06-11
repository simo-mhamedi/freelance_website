<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\articles;
use App\Models\Categorie;
use App\Models\Estimate;
use App\Models\Request as ModelsRequest;
use App\Models\Request_sub_categorie;
use App\Models\SubCategorie;
use App\Models\User;
use App\Models\UserCategorie;
use App\Models\UserMembership;
use App\Models\freelancerSuggestion;
use App\Models\User_categorie;
use App\Models\user_Rate;
use App\Models\user_Rating;
use App\Models\user_Review;
use Backpack\CRUD\app\Console\Commands\PublishBackpackMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\Internal\ReturnTypeContract;
use DougSisk\CountryState\CountryState;

class RequestController extends Controller
{
       // request actions
       public function request()
       {
           $user = Auth::user();
           if (!$user) {
               return redirect('/');
           }
           $request_recus = User::with([
               'requests' => function ($query) {
                   $query->withCount('estimates');
               },
           ])->find($user->id);
           return view('base.dashboard.requests.request', compact('request_recus'));
       }
       public function searchRequest(Request $request)
       {
           $request->session()->put('key', $request->key);
           $data = $request->session()->get('key');

           $user = Auth::user();
           if (!$user) {
               return redirect('/');
           }
           $request_recus = User::with([
               'requests' => function ($query) use ($request) {
                   $query->withCount('estimates')->where('title', 'LIKE', '%' . $request->key . '%');
               },
           ])->find($user->id);
           if ($request_recus->requests->count() > 0) {
               return view('base.dashboard.requests.request', compact('request_recus', 'data'));
           } else {
               $request_recus = User::with([
                   'requests' => function ($query) {
                       $query->withCount('estimates');
                   },
               ])->find($user->id);
               session()->flash('message', 'No user with matching requests found.');
               return view('base.dashboard.requests.request', compact('request_recus', 'data'));
           }
       }

       public function deleteSelectedRequest(Request $request)
       {
           $deletedRequestesArray = array_map('intval', explode(',', $request->deletedRequestes));
           ModelsRequest::whereIn('id', $deletedRequestesArray)->delete();
           return redirect('requests');
       }

       public function updateRequestView(Request $request)
       {
           $request_recu = json_decode($request->request_recu);

           $userCategorys = Request_sub_categorie::with('Sub_categorie')
               ->where('request_id', $request_recu->id)
               ->get();
            $article = articles::where('request_id', $request_recu->id)->get();
           $categories = Categorie::all();
           $subCagories = SubCategorie::all();
           return view('base.requests.update-request', compact('userCategorys', 'request_recu', 'categories', 'subCagories','article'));
       }

       public function deleteRequest($id)
       {
           // Perform the verification to check if the record exists
           $record = ModelsRequest::find($id);
           // Record exists, proceed with deletion
           $record->delete();
           return redirect('/requests');
       }

       public function newRequest()
       {
           $categories = Categorie::all();
           $subCagories = SubCategorie::all();
           $countryState = new CountryState();
           $countries = $countryState->getCountries();
           $countriesObjects = [];
            foreach ($countries as $code => $name) {
                $countryObject = (object) ['code' => $code, 'name' => $name];
                $countriesObjects[] = $countryObject;
            }
            $states = $countryState->getStates("MA");
           return view('base.requests.new-request', compact('categories', 'subCagories','countriesObjects','states'));
       }
       public function getCities(Request $request)
        {
            $country = $request->input('country');
            // Assuming you have a method in your service to get cities for a specific country
            $countryState = new CountryState();
            $states = $countryState->getStates($country);
            return response()->json($states);
        }
       public function saveNewRequest(Request $request)
       {
           $data = $request->articls; // Assuming $request->articls is the array you provided
           $title = trim($request->title, "\"");
           $interNational = trim($request->interNational, "\"");
           $national = trim($request->national, "\"");
           $selectedCity = trim($request->selectedCity, "\"");
           $selectedCountry = trim($request->selectedCountry, "\"");
           $date_deadline = trim($request->date_deadline, "\"");
           $input_min = (int) trim($request->input_min, "\"");
           $input_max = (int) trim($request->input_max, "\"");
           $newRequest = new ModelsRequest();
           $newRequest->requestNumber = rand(1000, 2000);
           $newRequest->title = $title;
           $newRequest->city = $selectedCity;
           $countryState = new CountryState();
           $country = $countryState->getCountryName($selectedCountry);
           $newRequest->country = $country;
           $newRequest->national = $national;
           $newRequest->isInterNational = $interNational;
           $newRequest->price_min = $input_min;
           $newRequest->price_max = $input_max;
           $newRequest->date_request = date('Y/m/d');
           $newRequest->date_deadline = $date_deadline;
           $newRequest->status = 'new';
           $user = Auth::user();
           $newRequest->user_id = $user->id;
           $newRequest->save();
           foreach (json_decode($request->list) as $cateid) {
               $requestCategorie = new Request_sub_categorie();
               $requestCategorie->request_id = $newRequest->id;
               $requestCategorie->subCategory_id = $this->getSubCategorieById($cateid)->id;
               $requestCategorie->save();
           }
           foreach ($data as $item) {
            // Check if any of the fields is null; if all are null, skip this item
            if (!is_null($item[0]) || !is_null($item[1]) || !is_null($item[2]) || !is_null($item[3])) {
                $article = new articles();
                $article->name = $item[0];
                $article->description = $item[1];
                $article->quantity = $item[2];
                $article->request_id = $newRequest->id;
                // Save the article to the database
                $article->save();
            }
        }
           return response()->json(['message' => 'Data received and processed successfully']);
       }

       private function getSubCategorieById($id)
       {
           return SubCategorie::find($id);
       }
       public function updateRequestProc(Request $request)
       {
           $data = $request->articls; // Assuming $request->articls is the array you provided

           $interNational = json_decode($request->interNational);
           $national = json_decode($request->national);
           $id = json_decode($request->id);
           $title = json_decode(($request->title));
           $lieu = json_decode(($request->lieu));

           $description = json_decode($request->description);
           $date_deadline = json_decode($request->date_deadline);
           $input_min = json_decode($request->input_min);
           $input_max = json_decode($request->input_max);
           $updatedRequest = ModelsRequest::where('id', $id)
               ->get()
               ->first();

           $updatedRequest->title = $title;
           $updatedRequest->lieu = $lieu;

           $updatedRequest->description = $description;
           $updatedRequest->price_min = $input_min;
           $updatedRequest->price_max = $input_max;
           $updatedRequest->date_deadline = $date_deadline;
           $updatedRequest->national = $national;
           $updatedRequest->isInterNational = $interNational;
           $updatedRequest->save();
           Request_sub_categorie::where('request_id', $id)->delete();
           foreach (json_decode($request->list) as $cateid) {
               $requestCategorie = new Request_sub_categorie();
               $requestCategorie->request_id = $id;
               $requestCategorie->subCategory_id = $this->getSubCategorieById($cateid)->id;
               $requestCategorie->save();
           }
        articles::where('request_id', $id)->delete();
        foreach ($data as $item) {
            // Check if any of the fields is null; if all are null, skip this item
            if (!is_null($item[0]) || !is_null($item[1])
            || !is_null($item[2]) || !is_null($item[3])) {
                $article = new articles();
                $article->name = $item[0];
                $article->description = $item[1];
                $article->quantity = $item[2];
                $article->request_id = $updatedRequest->id;
                // Save the article to the database
                $article->save();
            }
        }


       }

       public function requestInfosView($id)
       {
           $user = Auth::user();
           $request = ModelsRequest::withCount('estimates')
               ->where('id', $id)
               ->get()
               ->first();
           $estimate_recus = Estimate::with(['client.userratings'])
               ->where('request_id', $request->id)
               ->simplePaginate(10);
           return view('base.dashboard.requests.requestInfos', compact('request', 'estimate_recus'));
       }

       public function searchEtimatesFromRequestInfos(Request $req)
       {
           $user = Auth::user();
           $request = ModelsRequest::withCount('estimates')
               ->where('id', $req->id)
               ->get()
               ->first();
           $estimate_recus = Estimate::with('client')
               ->whereHas('client', function ($query) use ($req, $user) {
                   $query->where('companyName', 'LIKE', '%' . $req->key . '%')->where('client_id', $user->id);
               })
               ->simplePaginate(10);
           return view('base.dashboard.requests.requestInfos', compact('request', 'estimate_recus'));
       }


       public function compare(Request $request)
       {
           $articles=articles::where('request_id', $request->id)->get();
           $req=ModelsRequest::where('id', $request->id)->get()->first();
           return view("base.dashboard.requests.compare",compact('articles',"req"));
       }

       public function getSegg(Request $request){
           $articles_list=articles::whereIn('id', $request->selectedArticles)->get();
           $freelancerSuggestions = FreelancerSuggestion::with('freelancer', 'article')
           ->whereIn('article_id', $request->selectedArticles)
           ->orderBy('prix')
           ->get();

            return response()->json([
                'freelancerSuggestions' => $freelancerSuggestions,
                'articlesList' => $articles_list
            ]);
       }

       public function getCompanysSegg(Request $request){
        $articles_list = articles::where('request_id', $request->reqId)->pluck('id');
        $articles_quantity_sum = articles::where('request_id', $request->reqId)->sum('quantity');

        $freelancerSuggestions = FreelancerSuggestion::with('freelancer', 'article')
            ->whereIn('article_id', $articles_list)
            ->get();

        // Count the number of articles associated with each freelancer
        $freelancerArticleCounts = $freelancerSuggestions->groupBy('freelancer_id')
            ->map->count();

        // Get the freelancer IDs with the same count as the selected articles
        $matchedFreelancerIds = $freelancerArticleCounts->filter(function ($count) use ($articles_list) {
            return $count === $articles_list->count();
        })->keys();

        // Retrieve the freelancers with the matched IDs
        $matchedFreelancers = FreelancerSuggestion::with('freelancer', 'article')
        ->whereIn('freelancer_id', $matchedFreelancerIds)
        ->whereIn('article_id', $articles_list)
        ->select('freelancer_id', \DB::raw('SUM(prix) as prix'))
        ->groupBy('freelancer_id')
        ->get();
        return response()->json([
            'freelancerSuggestions' => $matchedFreelancers,
            'articles_quantity_sum' => $articles_quantity_sum
        ]);

    }
    public function generer(Request $request){
        $freelancerSuggestions = FreelancerSuggestion::with('freelancer', 'article')
            ->whereIn('id', json_decode($request->freelancerIds))
            ->orderBy('prix')
            ->get();
            $req=ModelsRequest::where('id', $freelancerSuggestions[0]->article->id)->get()->first();

        return view("base.dashboard.requests.finaleDevi",compact("freelancerSuggestions","req"));
    }
    public function genererwithCompany(Request $request){
        $freelancerSuggestions = FreelancerSuggestion::with('freelancer', 'article')
            ->where('freelancer_id', $request->freelancer_id)
            ->orderBy('prix')
            ->get();
            $req=ModelsRequest::where('id', $freelancerSuggestions[0]->article->id)->get()->first();

        return view("base.dashboard.requests.finaleDevi",compact("freelancerSuggestions","req"));
    }

}
