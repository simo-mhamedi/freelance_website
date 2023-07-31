<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RequestRequest;
use App\Models\Request;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RequestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RequestCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Request::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/request');
        CRUD::setEntityNameStrings('request', 'requests');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('requestNumber');
        CRUD::column('title');
        CRUD::column('description');
        CRUD::column('price_min');
        CRUD::column('price_max');
        CRUD::column('date_request');
        CRUD::column('date_deadline');
        CRUD::column('status');
        CRUD::column('user_id');
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

        CRUD::field('requestNumber')->validationRules('required|numeric|min:5');
        CRUD::field('title')->validationRules('required');
        CRUD::field('description')->validationRules('required');
        CRUD::field('price_min')->validationRules('required');
        CRUD::field('price_max')->validationRules('required');
        CRUD::field('date_request')->validationRules('required');
        CRUD::field('date_deadline')->validationRules('required');
        CRUD::field('status')->validationRules('required');
        CRUD::addField([
            'name' => 'user_id',
            'label' => 'user',
            'type' => 'enum',
            'options' => $this->getAllUsers(),
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

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $currentId = $this->crud->getCurrentEntryId();
        $users = User::pluck('email', 'id')->toArray();
        $resuest = Request::find($currentId);
        CRUD::field('requestNumber');
        CRUD::field('title');
        CRUD::field('description');
        CRUD::field('price_min');
        CRUD::field('price_max');
        CRUD::field('date_request');
        CRUD::field('date_deadline');
        CRUD::field('status');
        CRUD::addField([
            'name' => 'user_id',
            'label' => 'user',
            'type' => 'enum',
            'options' => $users,
            'default' => $resuest->user_id,
        ]);
    }
}
