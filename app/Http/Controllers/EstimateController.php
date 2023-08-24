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
class EstimateController extends Controller
{
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
      public function addEstimate(Request $request)
      {
        $estimate=new Estimate();
        $estimate->request_id=$request->reqId;
        $estimate->client_id=$request->clientId;
        $estimate->freelancer_id=Auth::user()->id;
        $estimate->estimate_date=date('Y-m-d');

        if ($request->file != 'undefined') {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file = $request->file('file');
            $file->storeAs('users-avatar', $fileName, 'public');
            $estimate->file = $fileName;
        }
        $estimate->save();
      }
}
