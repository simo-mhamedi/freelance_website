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

}
