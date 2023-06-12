<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Illuminate\Foundation\Auth\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
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
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('email');
        CRUD::column('password');
        CRUD::field('name');
        CRUD::field('email');
        CRUD::field('password');
        CRUD::field('image');
        CRUD::field('name');
        CRUD::field('companyName');
        CRUD::field('role');
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

        CRUD::setValidation(UserRequest::class);
        CRUD::field('name')->validationRules('required');
        CRUD::field('email')->validationRules('required');
        CRUD::field('password')->validationRules('required');
        CRUD::addField([   // Upload
            'name'      => 'image',
            'label'     => 'Image',
            'type'      => 'upload',
            'upload'    => true,
            'disk'    => 'public', // if you store files in the /public folder, please omit this; if you store them in /storage or S3, please specify it;
            // optional:
        ]);        CRUD::field('name')->validationRules('required');
        CRUD::field('companyName')->validationRules('required');
        CRUD::field('companyRepresentative')->validationRules('required');
        CRUD::field('rcCompany')->validationRules('required');
        CRUD::field('city')->validationRules('required');
        CRUD::field('country')->validationRules('required');
        CRUD::field('tele')->validationRules('required');
        CRUD::field('desc_Activity')->validationRules('required');
        CRUD::field('role')->type('enum')->options(['user' => 'User', 'admin' => 'Admin'])->validationRules('required');


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {

        CRUD::setValidation(UserRequest::class);
        CRUD::field('name');
        CRUD::field('email');
        CRUD::field('password');
    // CRUD::field('id');
    CRUD::addField([   // Upload
        'name'      => 'image',
        'label'     => 'Image',
        'type'      => 'upload',
        'upload'    => true,
        'disk'    => 'public', // if you store files in the /public folder, please omit this; if you store them in /storage or S3, please specify it;
        // optional:
    ]);
        CRUD::field('companyName');
        CRUD::field('companyRepresentative');
        CRUD::field('rcCompany');
        CRUD::field('city');
        CRUD::field('country');
        CRUD::field('tele');
        CRUD::field('desc_Activity');
        CRUD::field('role')->type('enum')->options(['user' => 'User', 'admin' => 'Admin']);
    }

}
