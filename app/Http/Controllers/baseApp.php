<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Estimate;
use App\Models\Request as ModelsRequest;
use App\Models\Request_sub_categorie;
use App\Models\SubCategorie;
use App\Models\UserMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class baseApp extends Controller
{
    public function index()
    {
        return view('home.home');
    }
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
    public function estimate()
    {
        $user = Auth::user();
        if (!$user) {
            return view('home.home');
        }
        $requests=ModelsRequest::where('user_id', $user->id)->get();
        $estimate_recus = Estimate::with('user')
        ->where('user_id', $user->id)
        ->get();
        return view('base.dashboard.estimates.estimate',compact('requests','estimate_recus'));
    }

    private function getUserDevisEnvoyer($id)
    {
        $all = 0;
        $user_Requests = ModelsRequest::where('user_id', $id)->get();
        foreach ($user_Requests as $user_Request) {
            $estimate = Estimate::where('request_id', $user_Request->id)
                ->get()
                ->first();
            if ($estimate) {
                $all++;
            }
        }
        return $all;
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
    public function selectEtimates(Request $request)
    {
        $user = Auth::user();
        $estimates = Estimate::where('request_id', $request->id)
        ->where('user_id', $user->id)
        ->get();
        return $estimates;

    }
}
