<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserMembershipRequest;
use App\Models\membership;
use App\Models\User;
use App\Models\user_membership;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserMembershipCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserMembershipCrudController extends CrudController
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
        CRUD::setModel(\App\Models\UserMembership::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user-membership');
        CRUD::setEntityNameStrings('user membership', 'user memberships');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('membership_id');
        CRUD::column('user_id');
        CRUD::column('estimates_restNumber');
        CRUD::column('estimates_number');
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
        CRUD::setValidation([
            // 'name' => 'required|min:2',
        ]);

        CRUD::addField([
            'name' => 'membership_id',
            'label' => 'membership',
            'type' => 'enum',
            'options' => $this->getAllMemberships(),
            'rules' => 'required',
        ]);
        CRUD::addField([
            'name' => 'user_id',
            'label' => 'user',
            'type' => 'enum',
            'options' => $this->getAllUsers(),
            'rules' => 'required',
        ]);
        CRUD::field('estimates_restNumber');
        CRUD::field('estimates_number');

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
        $currentId = $this->crud->getCurrentEntryId();
        $users = User::pluck('email', 'id')->toArray();
        $membership = user_membership::find($currentId);
        if ($membership) {
            CRUD::addField([
                'name' => 'membership_id',
                'label' => 'membership',
                'type' => 'enum',
                'options' => $users,
                'default' => $membership->membership_id,
            ]);
            CRUD::addField([
                'name' => 'user_id',
                'label' => 'user',
                'type' => 'enum',
                'options' => $users,
                'default' => $membership->user_id,
            ]);
        }
        else{
            CRUD::addField([
                'name' => 'membership_id',
                'label' => 'membership',
                'type' => 'enum',
                'options' => $this->getAllMemberships(),
                'rules' => 'required',
            ]);
            CRUD::addField([
                'name' => 'user_id',
                'label' => 'user',
                'type' => 'enum',
                'options' => $this->getAllUsers(),
                'rules' => 'required',
            ]);
        }
        CRUD::field('estimates_restNumber');
        CRUD::field('estimates_number');
    }

    protected function getAllMemberships()
    {
        $memberships = membership::pluck('name', 'id')->toArray();
        return $memberships;
    }
    protected function getAllUsers()
    {
        $users = User::pluck('email', 'id')->toArray();
        return $users;
    }
}
