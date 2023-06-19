<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Request as ModelsRequest;
use App\Models\Request_sub_categorie;
use App\Models\SubCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class baseApp extends Controller
{
    public function index()
    {
        return view("home.home");
    }
    public function newRequest()
    {
        $categories = Categorie::all();
        $subCagories = SubCategorie::all();
        return view("base.requests.new-request",compact('categories', 'subCagories'));
    }
    public function saveNewRequest(Request $request)
    {
        $newRequest=new ModelsRequest();
        $newRequest->requestNumber=rand(1000,2000);
        $newRequest->title=$request->title;
        $newRequest->description=$request->description;
        $newRequest->price_min=$request->input_min;
        $newRequest->price_max=$request->input_max;
        $newRequest->date_request=date("Y/m/d");
        $newRequest->date_deadline=$request->date_deadline;
        $newRequest->status="new";
        $user = Auth::user();
        $newRequest->user_id=$user->id;
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
