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
        $categories = Categorie::all();
        $subCagories = SubCategorie::all();
        $requests = ModelsRequest::with(['Sub_categorie', 'Sub_categorie.Sub_categorie'])
            ->with(['user.userratings', 'estimates'])
            ->take(7)
            ->get();
        $totale = $requests->count();
        $requests->transform(function ($request) {
            $creationDate = Carbon::parse($request->created_at);
            $request->hoursDifference = now()->diffInHours($creationDate);
            $request->minutesDifference = now()->diffInMinutes($creationDate);
            return $request;
        });
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
        Session::put('country', $country);
        Session::put('city', $city);
        $searchKey = $request->searchKey;
        $requests = ModelsRequest::with(['Sub_categorie', 'Sub_categorie.Sub_categorie'])
            ->with(['user.userratings', 'estimates'])
            ->whereBetween('price_min', [$minPrice, $maxPrice])
            ->orWhereBetween('price_max', [$minPrice, $maxPrice])
            ->get();
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
            $totale = $requests->count();
        }

        $categories = Categorie::all();
        $subCagories = SubCategorie::all();
        return view('base.search.main-search', compact('categories', 'subCagories', 'requests', 'totale'));
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
