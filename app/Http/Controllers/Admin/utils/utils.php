<?php

namespace App\Http\Controllers\Admin\utils;
use Illuminate\Foundation\Auth\User;

/**
 * Class CategorieCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class Utils implements IUtils
{
    public function getAllUsers()
    {
        $users = User::pluck('email', 'id')->toArray();
        return $users;
    }
}
