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
use App\Models\freelancerSuggestion;
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
              ->latest() // Get the most recent estimates first
              ->simplePaginate(10);

          return view('base.dashboard.estimates.estimate', [
              'requests' => $requests,
              'estimate_recus' => $estimate_recus,
          ]);
      }
      public function selectEtimates(Request $request)
      {
        $user = Auth::user();
        $requestId = $request->id; // Use $request->id directly

        // You can remove the session operations, as $request->id is already available
        // $request->session()->put('request', $request->id);
        // $requestId = $request->session()->get('request');

        $requests = ModelsRequest::where('user_id', $user->id)->get();

        $estimate_recus = Estimate::where('request_id', $requestId) // Use $requestId
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
          // Validate the request data if necessary

          // Create a new estimate
          $rq = ModelsRequest::where('id',$request->request_id)->first();
          $existingEstimate = Estimate::where('request_id', $rq->id)
          ->where('freelancer_id', Auth::id())
          ->first();
          $estimate = new Estimate();
          $estimate->reference= rand(1, 5000);
          $estimate->request_id =$rq->id ;
          $estimate->client_id = $rq->user_id;
          $estimate->freelancer_id = Auth::user()->id;
          $estimate->estimate_date = now(); // Use Carbon instance for current date
          $estimate->save();



            if ($existingEstimate !=null) {
            // Return an error response
                return response()->json(['error' => 'An estimate already exists for this request.'], 400);
            }
            // Prepare an array to store all the FreelancerSuggestion instances
          $freelancerSuggestions = [];

          // Loop through each article and create a FreelancerSuggestion instance
          foreach ($request->article as $articleId => $articleData) {
            // Extract article data
            $prix = $articleData['prix'];
            $note = $articleData['note'];

            // Create a new FreelancerSuggestion instance
            $freelancerSuggestion = new FreelancerSuggestion();
            $freelancerSuggestion->prix = $prix;
            $freelancerSuggestion->note = $note;
            $freelancerSuggestion->freelancer_id =      $estimate->freelancer_id;
            $freelancerSuggestion->article_id = $articleId; // Set the article_id

            // Save the instance
            $freelancerSuggestion->save();
            }

          // Mass insert the FreelancerSuggestion instances
      }

}
