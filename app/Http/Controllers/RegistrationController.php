<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    private static $user;

    public function userInfos()
    {
        return view("base.auth.registration-inc.user-infos");
    }
    public function toCompanyInfos(Request $request)
    {
        self::$user=new User();
        self::$user->email=$request->email;
        self::$user->password=$request->password;
        return redirect("/company-infos");
    }
    public function companyInfos()
    {
        return view("base.auth.registration-inc.company-infos");
    }
    public function toUserCategoryInfos(Request $request)
    {
        return redirect("/user-category-infos");
    }
    public function userCategoryInfos()
    {
        return view("base.auth.registration-inc.user-categorys");
    }

}
