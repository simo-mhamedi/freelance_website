<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Estimate;
use App\Models\Request as ModelsRequest;
use App\Models\Request_sub_categorie;
use App\Models\SubCategorie;
use App\Models\User;
use App\Models\UserCategorie;
use App\Models\UserMembership;
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

class baseApp extends Controller
{
    public function index()
    {
        return view('home.home');
    }
    // dashboard actions
    public function dashboard()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/');
        }
        $user_historique = UserMembership::where('user_id', $user->id)
            ->get()
            ->first();
        if ($user_historique) {
            $consum_estimate = $user_historique->estimates_restNumber - $user_historique->estimates_restNumberestimates_number;
        } else {
            $consum_estimate = 0;
        }
        $estimate_send = Estimate::where('freelancer_id', $user->id)->count();
        $estimate_recus = Estimate::where('client_id', $user->id)->count();
        $allEstimates = Estimate::all()->count();
        $lastsEstimates = Estimate::with('client')
            ->where('client_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('base.dashboard.dashboard', compact('user_historique', 'consum_estimate', 'estimate_send', 'estimate_recus', 'allEstimates', 'lastsEstimates'));
    }
    // estimate receive
    public function estimate()
    {
        $user = Auth::user();
        if (!$user) {
            return view('home.home');
        }
        $requests = ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = Estimate::with('client')
            ->where('client_id', $user->id)
            ->simplePaginate(10);
        return view('base.dashboard.estimates.estimate', compact('requests', 'estimate_recus'));
    }
    public function selectEtimates(Request $request)
    {
        $request->session()->put('request', $request->id);
        $requestId = $request->session()->get('request');
        $user = Auth::user();
        $requests = ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = Estimate::where('request_id', $request->id)
            ->where('client_id', $user->id)
            ->simplePaginate(10);
        return view('base.dashboard.estimates.estimate', compact('requests', 'estimate_recus', 'requestId'));
    }

    public function selectDateEtimates(Request $request)
    {
        $request->session()->put('date', $request->date);
        $data = $request->session()->get('date');
        $user = Auth::user();
        $requests = ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = Estimate::with('client')
            ->where('estimate_date', $request->date)
            ->where('client_id', $user->id)
            ->simplePaginate(10);
        return view('base.dashboard.estimates.estimate', compact('requests', 'estimate_recus', 'data'));
    }

    public function searchEtimates(Request $request)
    {
        $user = Auth::user();
        $requests = ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = Estimate::with('client')
            ->whereHas('client', function ($query) use ($request, $user) {
                $query->where('companyName', 'LIKE', '%' . $request->key . '%')->where('client_id', $user->id);
            })
            ->simplePaginate(10);
        return view('base.dashboard.estimates.estimate', compact('requests', 'estimate_recus'));
    }
    // estimate Send
    public function estimateSend()
    {
        $user = Auth::user();
        if (!$user) {
            return view('home.home');
        }
        $requests = ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = Estimate::with('freelancer')
            ->where('freelancer_id', $user->id)
            ->simplePaginate(10);
        return view('base.dashboard.estimates.estimate_send', compact('requests', 'estimate_recus'));
    }

    public function selectSendEtimates(Request $request)
    {
        $request->session()->put('request', $request->id);
        $requestId = $request->session()->get('request');
        $user = Auth::user();
        $requests = ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = Estimate::where('request_id', $request->id)
            ->where('freelancer_id', $user->id)
            ->simplePaginate(10);
        return view('base.dashboard.estimates.estimate_send', compact('requests', 'estimate_recus', 'requestId'));
    }

    public function selectSendDateEtimates(Request $request)
    {
        $request->session()->put('date', $request->date);
        $data = $request->session()->get('date');
        $user = Auth::user();
        $requests = ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = Estimate::with('freelancer')
            ->where('estimate_date', $request->date)
            ->where('freelancer_id', $user->id)
            ->simplePaginate(10);
        return view('base.dashboard.estimates.estimate_send', compact('requests', 'estimate_recus', 'data'));
    }

    public function searchSendEtimates(Request $request)
    {
        $user = Auth::user();
        $requests = ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = Estimate::with('freelancer')
            ->whereHas('freelancer', function ($query) use ($request, $user) {
                $query->where('companyName', 'LIKE', '%' . $request->key . '%')->where('freelancer_id', $user->id);
            })
            ->simplePaginate(10);
        return view('base.dashboard.estimates.estimate_send', compact('requests', 'estimate_recus'));
    }
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
        $categories = Categorie::all();
        $subCagories = SubCategorie::all();
        return view('base.requests.update-request', compact('userCategorys', 'request_recu', 'categories', 'subCagories'));
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
        return view('base.requests.new-request', compact('categories', 'subCagories'));
    }
    public function saveNewRequest(Request $request)
    {
        $title = trim($request->title, "\"");
        $description = trim($request->description, "\"");
        $date_deadline = trim($request->date_deadline, "\"");
        $input_min = (int) trim($request->input_min, "\"");
        $input_max = (int) trim($request->input_max, "\"");

        $newRequest = new ModelsRequest();
        $newRequest->requestNumber = rand(1000, 2000);
        $newRequest->title = $title;
        $newRequest->description = $description;
        $newRequest->price_min = $input_min;
        $newRequest->price_max = $input_max;
        $newRequest->date_request = date('Y/m/d');
        $newRequest->date_deadline = $date_deadline;
        $newRequest->status = 'new';
        $user = Auth::user();
        $newRequest->user_id = $user->id;
        $newRequest->save();
        foreach (json_decode($request->list) as $id) {
            $requestCategorie = new Request_sub_categorie();
            $requestCategorie->request_id = $newRequest->id;
            $requestCategorie->subCategory_id = $this->getSubCategorieById($id)->id;
            $requestCategorie->save();
        }
        return response()->json(['message' => 'Data received and processed successfully']);
    }

    private function getSubCategorieById($id)
    {
        return SubCategorie::find($id);
    }
    public function updateRequestProc(Request $request)
    {
        $id = json_decode($request->id);
        $title = json_decode($request->title);
        $description = json_decode($request->description);
        $date_deadline = json_decode($request->date_deadline);
        $input_min = json_decode($request->input_min);
        $input_max = json_decode($request->input_max);
        $updatedRequest = ModelsRequest::where('id', $id)
            ->get()
            ->first();
        $updatedRequest->title = $title;
        $updatedRequest->description = $description;
        $updatedRequest->price_min = $input_min;
        $updatedRequest->price_max = $input_max;
        $updatedRequest->date_deadline = $date_deadline;
        $updatedRequest->save();
        Request_sub_categorie::where('request_id', $id)->delete();
        foreach (json_decode($request->list) as $cateid) {
            $requestCategorie = new Request_sub_categorie();
            $requestCategorie->request_id = $id;
            $requestCategorie->subCategory_id = $this->getSubCategorieById($cateid)->id;
            $requestCategorie->save();
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
            ->where('client_id', $user->id)
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

    public function addUserReview(Request $request)
    {
        $user = Auth::user();
        $estimate = Estimate::where('id', $request->id)
            ->get()
            ->first();
        $estimate->rating = $request->stars;
        $userRate = new user_Rate();
        $userRate->user_id = $user->id;
        $userRate->estimate_id = $request->id;
        $userRate->review = $request->stars;
        $userRate->save();
        $estimate->save();
        return response()->json(['message' => 'Data received and processed successfully']);
    }

    public function profileInfos()
    {
        $user = Auth::user();

        return view('base.profile.profile-infos', compact('user'));
    }
    public function updateprofileInfos()
    {
        $user = Auth::user();
        $userCategorys = User_categorie::with('Sub_categorie')
            ->where('user_id', $user->id)
            ->get();
        $categories = Categorie::all();
        $subCagories = SubCategorie::all();
        return view('base.profile.update-profile', compact('userCategorys', 'user', 'categories', 'subCagories'));
    }

    public function updateprofileInfosProcess(Request $request)
    {
        $user = User::find(auth()->id());

        if ($request->photo != 'undefined') {
            $photo = $request->file('photo');
            $fileName = time() . '_' . $photo->getClientOriginalName();
            $photo = $request->file('photo');
            $photo->storeAs('files/images', $fileName, 'public');
            $user->image = 'files/images/' . $fileName;
        }
        $user->name = $request->name;
        $user->email = $request->mail;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->tele = $request->tele;
        $user->desc_Activity = $request->desc;
        $user->rcCompany = $request->rc;
        $user->save();
        UserCategorie::where('user_id', $user->id)->delete();
        foreach (json_decode($request->list) as $id) {
            $userCategorie = new UserCategorie();
            $userCategorie->user_id = $user->id;
            $userCategorie->sub_category_id = $this->getSubCategorieById($id)->id;
            $userCategorie->save();
        }
    }

    public function searchMain()
    {
        $categories = Categorie::all();
        $subCagories = SubCategorie::all();
        $requests = ModelsRequest::with(['Sub_categorie', 'Sub_categorie.Sub_categorie'])
            ->with(['user.userratings', 'estimates'])
            ->take(7)
            ->get();
        $totale = $requests->count();

        return view('base.search.main-search', compact('categories', 'subCagories', 'requests', 'totale'));
    }

    public function searchMainProc(Request $request)
    {
        // Filter by name
        // Decode the JSON values and store them in variables
        $totale = 0;
        $checkedValues = $checkedValuesArray = explode(',', $request->checkedValues);
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
        $country = $request->country;
        $city = $request->city;
        $searchKey = $request->searchKey;
        $requests = ModelsRequest::with(['Sub_categorie', 'Sub_categorie.Sub_categorie'])
            ->with(['user.userratings', 'estimates'])
            ->whereBetween('price_min', [$minPrice, $maxPrice])
            ->orWhereBetween('price_max', [$minPrice, $maxPrice])
            ->get();
        $totale = $requests->count();
        if ($checkedValues[0] != '') {
            $filteredRequests = [];
            $total = 0;
            foreach ($requests as $req) {
                $hasSubCategory = false;
                foreach ($req->Sub_categorie as $subCategory) {
                    $subCategoryId = $subCategory->subCategory_id;
                    // Check if the subCategory_id is in $checkedValues array
                    if (in_array($subCategoryId, $checkedValues)) {
                        $hasSubCategory = true;
                        break; // No need to continue checking if the category is found
                    }
                }

                // If the request has the selected sub-category, add it to the filteredRequests array
                if ($hasSubCategory) {
                    $filteredRequests[] = $req;
                    $total++;
                }
            }
            $requests = $filteredRequests;
            $totale = $total;
        }
        // Filter by user's attributes (country, city, searchKey)
        if (!empty($country) || !empty($city) || !empty($searchKey)) {
            $requests = $requests->filter(function ($request) use ($country, $city, $searchKey) {
                $user = User::where('id', $request->user_id);

                if (!empty($country)) {
                    $user->where('country', 'like', '%' . $country . '%');
                }

                if (!empty($city)) {
                    $user->where('city', 'like', '%' . $city . '%');
                }

                if (!empty($searchKey)) {
                    $user->where('companyName', 'like', '%' . $searchKey . '%');
                }

                return $user->exists();
            });
        }
        $categories = Categorie::all();
        $subCagories = SubCategorie::all();
        return view('base.search.main-search', compact('categories', 'subCagories', 'requests', 'totale'));
    }

    public function offreInfos(Request $req)
    {
        $request = json_decode($req['req']);
        $ratings=$request->user->userratings;
        // Calculate the total sum of ratings
        $totalRatings = count($ratings);
        $sumRatings = 0;
        foreach ($ratings as $rating) {
            $sumRatings += intval($rating->review);
        }
        $estimates = count($request->estimates);

        // Calculate the average rating
        $averageRating = $totalRatings > 0 ? $sumRatings / $totalRatings : 0;
        $roundedAverageRating = round($averageRating);

        $estimatesCount = is_array($request->estimates) ? count($request->estimates) : 0;
        $subCategories = $request->sub_categorie;
        return view('base.search.offre-infos', compact('request', 'estimatesCount', 'subCategories',"roundedAverageRating","estimates"));
    }
}
