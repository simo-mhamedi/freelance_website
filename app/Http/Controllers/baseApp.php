<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Estimate;
use App\Models\Request as ModelsRequest;
use App\Models\Request_sub_categorie;
use App\Models\SubCategorie;
use App\Models\User;
use App\Models\UserMembership;
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
        $estimate_send = $this->getUserDevisEnvoyer($user->id);
        $estimate_recus = Estimate::where('user_id', $user->id)->count();
        return view('base.dashboard.dashboard', compact('user_historique', 'consum_estimate', 'estimate_send', 'estimate_recus'));
    }
    private function getUserDevisEnvoyer($id)
    {
        $all = 0;
        $user_Requests = ModelsRequest::where('user_id', $id)->get();
        foreach ($user_Requests as $user_Request) {
            $estimate = Estimate::where('request_id', $user_Request->id)->get();
            if ($estimate->count() > 0) {
                $all++;
            }
        }
        return $all;
    }
    // estimate receive
    public function estimate()
    {
        $user = Auth::user();
        if (!$user) {
            return view('home.home');
        }
        $requests = ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = Estimate::with('user')
            ->where('user_id', $user->id)
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
        ->where('user_id', $user->id)
        ->simplePaginate(10);
        return view('base.dashboard.estimates.estimate', compact('requests','estimate_recus', 'requestId'));
    }

    public function selectDateEtimates(Request $request)
    {
        $request->session()->put('date', $request->date);
        $data = $request->session()->get('date');
        $user = Auth::user();
        $requests = ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = Estimate::with('user')
            ->where('estimate_date', $request->date)
            ->where('user_id', $user->id)
            ->simplePaginate(10);
        return view('base.dashboard.estimates.estimate', compact('requests', 'estimate_recus', 'data'));
    }

    public function searchEtimates(Request $request)
    {
        $user = Auth::user();
        $requests = ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = Estimate::with('user')
            ->where('request_id', $request->id)
            ->where('user_id', $user->id)
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
        $estimate_recus = collect();

        foreach ($requests as $request) {
            $estimate = Estimate::where('request_id', $request->id)->first();
            $estimate_recus->push($estimate);
        }

        $perPage = 10;
        $page = request()->get('page', 1);

        $paginatedEstimates = new LengthAwarePaginator($estimate_recus->forPage($page, $perPage), $estimate_recus->count(), $perPage, $page, ['path' => LengthAwarePaginator::resolveCurrentPath()]);
        return view('base.dashboard.estimates.estimate_send', compact('requests', 'paginatedEstimates'));
    }

    public function selectSendEtimates(Request $request)
    {
        $request->session()->put('request', $request->id);
        $requestId = $request->session()->get('request');
        $user = Auth::user();
        $requests = ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = collect();

        foreach ($requests as $request) {
            if ($request->id == $request->id) {
                $estimate = Estimate::where('request_id', $request->id)->first();
                $estimate_recus->push($estimate);
            }
        }

        $perPage = 10;
        $page = request()->get('page', 1);

        $paginatedEstimates = new LengthAwarePaginator($estimate_recus->forPage($page, $perPage), $estimate_recus->count(), $perPage, $page, ['path' => LengthAwarePaginator::resolveCurrentPath()]);
        return view('base.dashboard.estimates.estimate_send', compact('requests', 'paginatedEstimates', 'requestId'));
    }

    public function selectSendDateEtimates(Request $request)
    {
        $request->session()->put('date', $request->date);
        $data = $request->session()->get('date');
        $user = Auth::user();
        $requests = ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = collect();

        foreach ($requests as $estimate) {
            $estimat = Estimate::where('request_id', $estimate->id)
                ->where('estimate_date', $request->date)
                ->first();
            $estimate_recus->push($estimat);
        }

        $perPage = 10;
        $page = request()->get('page', 1);

        if ($estimate_recus->isEmpty()) {
            // Return an empty list or handle the empty case as desired
            $paginatedEstimates = new LengthAwarePaginator([], 0, $perPage, $page, ['path' => LengthAwarePaginator::resolveCurrentPath()]);
        } else {
            $paginatedEstimates = new LengthAwarePaginator($estimate_recus->forPage($page, $perPage), $estimate_recus->count(), $perPage, $page, ['path' => LengthAwarePaginator::resolveCurrentPath()]);
        }
        return view('base.dashboard.estimates.estimate_send', compact('requests', 'paginatedEstimates', 'data'));
    }

    public function searchSendEtimates(Request $request)
    {
        $user = Auth::user();
        $requests = ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = Estimate::with('user')
            ->where('request_id', $request->id)
            ->where('user_id', $user->id)
            ->simplePaginate(10);
        return view('base.dashboard.estimates.estimate', compact('requests', 'estimate_recus'));
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
        $categories = Categorie::all();
        $subCagories = SubCategorie::all();
        return view('base.requests.update-request', compact('request_recu', 'categories', 'subCagories'));
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
        $newRequest = new ModelsRequest();
        $newRequest->requestNumber = rand(1000, 2000);
        $newRequest->title = $request->title;
        $newRequest->description = $request->description;
        $newRequest->price_min = $request->input_min;
        $newRequest->price_max = $request->input_max;
        $newRequest->date_request = date('Y/m/d');
        $newRequest->date_deadline = $request->date_deadline;
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
}
