<?php

namespace App\Http\Controllers\Admin\utils;
use Illuminate\Foundation\Auth\User;

/**
 * Class CategorieCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
interface IUtils
{
    function getAllUsers();
}
