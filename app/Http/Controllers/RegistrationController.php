<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\SubCategorie;
use App\Models\User;
use App\Models\UserCategorie;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use thiagoalessio\TesseractOCR\TesseractOCR;

class RegistrationController extends Controller
{
    public function userInfos()
    {
        return view('base.auth.registration-inc.user-infos');
    }
    public function toCompanyInfos(Request $request)
    {
        $data = session()->get('firstPageData');
        if ($data == null || $data["email"]!=$request->email) {
            $data = $request->only(['email', 'password']);
            $request->session()->put('firstPageData', $data);
        }
        return redirect('/company-infos');
    }
    public function companyInfos()
    {
        $data = session()->get('firstPageData');
        return view('base.auth.registration-inc.company-infos')->with('data', $data);
    }
    public function toUserCategoryInfos(Request $request)
    {
        $data = $request->session()->get('firstPageData');
        $data += $request->only(['societeName', 'companyRepresentative', 'rsSociete', 'city', 'country','email1','email2', 'areaCode','tel']);
        $request->session()->put('firstPageData', $data);
        return redirect('/user-category-infos');
    }
    public function userCategoryInfos()
    {
        $categories = Categorie::all();
        $subCagories = SubCategorie::all();
        return view('base.auth.registration-inc.user-categorys', compact('categories', 'subCagories'));
    }
    public function signUp(Request $request)
    {
        $data = $request->session()->get('firstPageData');
        if ($data == null) {
            return response()->json('you are not allowd', 405);
        } else {
            if ($this->checkIfUserAlraedyExist($data['email'])) {
                return response()->json('this email is already exist');
            }
            $user = new User();
            $user->email = $data['email'];
            $user->email2 = $data['email1'];
            $user->email3 = $data['email2'];
            $user->password = bcrypt($data['password']);
            $user->companyName = $data['societeName'];
            $user->companyRepresentative = $data['companyRepresentative'];
            $user->city = $data['city'];
            $user->country = $data['country'];
            $user->rcCompany = $data['rsSociete'];
            $user->tele = $data['tel'];
            $user->areaCode = $data["areaCode"];
            $user->desc_Activity = $request['desc'];
            $user->save();
            foreach (json_decode($request->list) as $id) {
                $userCategorie = new UserCategorie();
                $userCategorie->user_id = $user->id;
                $userCategorie->sub_category_id = $this->getSubCategorieById($id)->id;
                $userCategorie->save();
            }
            Auth::loginUsingId($user->id);
            $request->session()->forget('firstPageData');
            return response()->json(['message' => 'Data received and processed successfully']);
        }
    }

    private function getSubCategorieById($id)
    {
        return SubCategorie::find($id);
    }

    public function backToUserInfo()
    {
        $data = session()->get('firstPageData');
        return view('base.auth.registration-inc.user-infos')->with('data', $data);
    }

    public function backToUserCategorys()
    {
        $data = session()->get('firstPageData');
        return view('base.auth.registration-inc.user-categorys')->with('data', $data);
    }

    public function backToCompanyInfos()
    {
        $data = session()->get('firstPageData');
        return view('base.auth.registration-inc.company-infos')->with('data', $data);
    }

    private function checkIfUserAlraedyExist($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            return true;
        } else {
            return false;
        }
    }
    public function signInView()
    {
        return view('base.auth.auth-page');
    }

    public function signIn(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication successful
            $user = Auth::user();
            if ($request->saveOnSession) {
                Session::put('user', $user);
            }
            return redirect()->intended('/');
        } else {
            // Authentication failed
            return redirect()
                ->back()
                ->withErrors(['error' => 'Invalid credentials']);
        }
    }


}
