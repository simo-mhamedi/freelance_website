<?php

namespace App\Http\Controllers;

use App\Models\articles;
use App\Models\Categorie;
use App\Models\Estimate;
use App\Models\Request as ModelsRequest;
use App\Models\Request_sub_categorie;
use App\Models\security_processes;
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
use Illuminate\Support\Facades\Session;
use JetBrains\PhpStorm\Internal\ReturnTypeContract;
use Carbon\Carbon;
use Smalot\PdfParser\Parser;
use thiagoalessio\TesseractOCR\TesseractOCR;
use DougSisk\CountryState\CountryState;
class UserController extends Controller
{
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
            $photo->storeAs('users-avatar', $fileName, 'public');
            $user->avatar = $fileName;
        }
        if ($request->fileCompany != 'undefined') {
            $fileCompany = $request->file('fileCompany');
            $check=$this->extractTextimg($fileCompany);
            if($check)
            {
                $user->isVerified=true;
            }
            else{
                $user->isVerified=false;
            }
        }
        $user->name = $request->name;
        $user->email = $request->mail;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->tele = $request->tele;
        $user->areaCode = $request->areaCode;
        $user->desc_Activity = $request->desc;
        $user->rcCompany = $request->rc;
        $user->companyName = $request->companyName;
        $user->save();
        UserCategorie::where('user_id', $user->id)->delete();
        foreach (json_decode($request->list) as $id) {
            $userCategorie = new UserCategorie();
            $userCategorie->user_id = $user->id;
            $userCategorie->sub_category_id = $this->getSubCategorieById($id)->id;
            $userCategorie->save();
        }
    }
    public function extractTextimg($imageFile)
    {
        $words = security_processes::all();
        $text = (new TesseractOCR($imageFile))->run();
        $text = strtolower($text);
        $foundWord = false;
        foreach ($words as $word) {
            $word = strtolower($word->rcCompany);
            if (strpos($text, $word) !== false) {
                $foundWord = true;
                break;
            }
        }
        return  $foundWord;
    }
    private function getSubCategorieById($id)
    {
        return SubCategorie::find($id);
    }
    public function searchMain()
    {
        $countryState = new CountryState();

        $countries = $countryState->getCountries();
        $countriesObjects = [];
         foreach ($countries as $code => $name) {
             $countryObject = (object) ['code' => $code, 'name' => $name];
             $countriesObjects[] = $countryObject;
         }
         $states = $countryState->getStates("MA");

        $categories = Categorie::all();
        $subCagories = SubCategorie::all();
        $filteredRequests = ModelsRequest::with(['Sub_categorie', 'Sub_categorie.Sub_categorie'])
            ->with(['user.userratings', 'estimates'])
            ->whereNot("user_id",auth()->id())
            ->take(7)->orderByDesc("id")
            ->get();
        $totale = $filteredRequests->count();
        $filteredRequests->transform(function ($request) {
            $creationDate = Carbon::parse($request->created_at);
            $request->hoursDifference = now()->diffInHours($creationDate);
            $request->minutesDifference = now()->diffInMinutes($creationDate);
            return $request;
        });
        return view('base.search.main-search', compact('categories', 'subCagories','countriesObjects', 'states','filteredRequests', 'totale'));
    }
    public function searchByKey(Request $request)
    {
        $filteredRequests = ModelsRequest::with(['Sub_categorie', 'Sub_categorie.Sub_categorie'])
        ->with(['user.userratings', 'estimates'])
        ->where('title', 'like', '%' . $request->searchKey . '%') // Check if the title contains the search key
        ->whereNot("user_id",auth()->id())
        ->get();
        $totale=$filteredRequests->count();
        $categories = Categorie::all();
        $subCagories = SubCategorie::all();
        $countryState = new CountryState();
        $countries = $countryState->getCountries();

        $countryState = new CountryState();

        $countries = $countryState->getCountries();
        $countriesObjects = [];
         foreach ($countries as $code => $name) {
             $countryObject = (object) ['code' => $code, 'name' => $name];
             $countriesObjects[] = $countryObject;
         }
         $states = $countryState->getStates("MA");
         return view('base.search.main-search', compact('categories', 'subCagories','countriesObjects', 'states','filteredRequests', 'totale'));
        }

    public function searchMainProc(Request $request)
    {
        $countryState = new CountryState();
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
        $country = $request->country;
        $city = $request->city;
        $searchKey = $request->searchKey;
        $countries = $countryState->getCountries();
        $countriesObjects = [];
        $states = $countryState->getStates('MA');
         foreach ($countries as $code => $name) {
             $countryObject = (object) ['code' => $code, 'name' => $name];
             $countriesObjects[] = $countryObject;
         }
        $requests = ModelsRequest::with(['Sub_categorie', 'Sub_categorie.Sub_categorie', 'user.userratings', 'estimates'])
            ->whereNot("user_id", auth()->id());
            if (!empty($request->checkedValues)) {
                $checkedValues = explode(',', $request->checkedValues);
                $requests->whereHas('Sub_categorie', function ($query) use ($checkedValues) {
                    $query->whereIn('subCategory_id', $checkedValues);
                });
            }
        if (!empty($country)) {
            echo "<script>localStorage.setItem('country', '" . $country . "');</script>";
            $states = $countryState->getStates($country);
            $country = $countryState->getCountryName($country);
            $requests->where('country', 'like', '%' . $country . '%');
        }

        if (!empty($city)) {
            $requests->where('city', 'like', '%' . $city . '%');
        }


        // if (!empty($searchKey)) {
        //     $requests->whereHas('user', function ($query) use ($searchKey) {
        //         $query->where('companyName', 'like', '%' . $searchKey . '%');
        //     });
        // }

        echo "<script>localStorage.setItem('city', '" . $city . "');</script>";

        $totale = $requests->count();
        $filteredRequests = $requests->get();

        $categories = Categorie::all();
        $subCagories = SubCategorie::all();

        return view('base.search.main-search', compact('categories', 'subCagories','countriesObjects', 'states','filteredRequests', 'totale'));
    }


    public function offreInfos(Request $req)
    {
        $request = json_decode($req['req']);
        $requestUpdate = ModelsRequest::where('id', $request->id)
            ->get()
            ->first();
        $requestUpdate->viewsNumber = $requestUpdate->viewsNumber + 1;
        $requestUpdate->save();
        $ratings = $request->user->userratings;
        $request->viewsNumber = $requestUpdate->viewsNumber;
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
        $article = articles::where('request_id', $requestUpdate->id)->get();

        return view('base.search.offre-infos', compact('request', 'estimatesCount', 'subCategories', 'roundedAverageRating', 'estimates','article'));
    }
}
