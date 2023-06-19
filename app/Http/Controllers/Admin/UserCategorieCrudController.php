<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserCategorieRequest;
use App\Models\Categorie;
use App\Models\Request;
use App\Models\Sub_categorie;
use App\Models\User;
use App\Models\User_categorie;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCategorieCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCategorieCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\UserCategorie::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user-categorie');
        CRUD::setEntityNameStrings('user categorie', 'user categories');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('user_id');
        CRUD::column('sub_category_id');
        CRUD::column('created_at');
        CRUD::column('updated_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {

        CRUD::addField([
            'name' => 'user_id',
            'label' => 'user',
            'type' => 'enum',
            'options' => $this->getAllUsers(),
            'rules' => 'required',
        ]);
        CRUD::addField([
            'name' => 'sub_category_id',
            'label' => 'sub categorys',
            'type' => 'enum',
            'options' => $this->getAllRequests(),
            'rules' => 'required',
        ]);
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }
    protected function getAllUsers()
    {
        $users = User::pluck('email', 'id')->toArray();
        return $users;
    }
    protected function getAllRequests()
    {
        $requests = Sub_categorie::pluck('subCategoryName', 'id')->toArray();
        return $requests;
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $currentId = $this->crud->getCurrentEntryId();
        $userCategory = User_categorie::find($currentId);
        CRUD::addField([
            'name' => 'user_id',
            'label' => 'user',
            'type' => 'enum',
            'options' => $this->getAllUsers(),
            'rules' => 'required',
            'default' => $userCategory->user_id,
        ]);
        CRUD::addField([
            'name' => 'sub_category_id',
            'label' => 'sub categorys',
            'type' => 'enum',
            'options' => $this->getAllRequests(),
            'rules' => 'required',
            'default' => $userCategory->sub_category_id,
        ]);
    }
}
