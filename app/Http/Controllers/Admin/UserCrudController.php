<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\membership;
use App\Models\userMembership;
use App\Models\user_membership;
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
        CRUD::column('name')->label('Nom');
        CRUD::column('email')->label('E-mail');
        CRUD::column('password')->label('Mot de passe');

        CRUD::field('name')->label('Nom');
        CRUD::field('email')->label('E-mail');
        CRUD::field('password')->label('Mot de passe');
        CRUD::field('image')->label('Image');
        CRUD::field('name')->label('Nom');
        CRUD::field('companyName')->label('Nom de l\'entreprise');
        CRUD::field('has_Membership')->label('A-t-il une adhésion ?');
        CRUD::field('role')
            ->type('enum')
            ->options(['user' => 'Utilisateur', 'admin' => 'Administrateur'])
            ->label('Rôle');

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

        CRUD::field('name')
            ->label('Nom')
            ->validationRules('required');
        CRUD::field('email')
            ->label('E-mail')
            ->validationRules('required');
        CRUD::field('password')
            ->label('Mot de passe')
            ->validationRules('required');
        CRUD::field('companyName')
            ->label('Nom de l\'entreprise')
            ->validationRules('required');
        CRUD::field('companyRepresentative')
            ->label('Représentant de l\'entreprise')
            ->validationRules('required');
        CRUD::field('rcCompany')
            ->label('Numéro RC de l\'entreprise')
            ->validationRules('required');
        CRUD::field('city')
            ->label('Ville')
            ->validationRules('required');
        CRUD::field('country')
            ->label('Pays')
            ->validationRules('required');
        CRUD::field('tele')
            ->label('Téléphone')
            ->validationRules('required');
        CRUD::field('desc_Activity')
            ->label('Description de l\'activité')
            ->validationRules('required');

        CRUD::field('role')
            ->type('enum')
            ->options(['user' => 'user', 'admin' => 'admin'])
            ->label('Rôle')
            ->validationRules('required');

        CRUD::addField([
            'name' => 'membership_id',
            'label' => 'Adhésion',
            'type' => 'enum',
            'options' => $this->getAllMemberships(),
            'rules' => 'required',
        ]);

        CRUD::field('has_Membership')->label('A-t-il une adhésion ?');

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
        CRUD::field('name')
        ->label('Nom')
        ->validationRules('required');
    CRUD::field('email')
        ->label('E-mail')
        ->validationRules('required');
    CRUD::field('password')
        ->label('Mot de passe')
        ->validationRules('required');
    CRUD::field('companyName')
        ->label('Nom de l\'entreprise')
        ->validationRules('required');
    CRUD::field('companyRepresentative')
        ->label('Représentant de l\'entreprise')
        ->validationRules('required');
    CRUD::field('rcCompany')
        ->label('Numéro RC de l\'entreprise')
        ->validationRules('required');
    CRUD::field('city')
        ->label('Ville')
        ->validationRules('required');
    CRUD::field('country')
        ->label('Pays')
        ->validationRules('required');
    CRUD::field('tele')
        ->label('Téléphone')
        ->validationRules('required');
    CRUD::field('desc_Activity')
        ->label('Description de l\'activité')
        ->validationRules('required');

    CRUD::field('role')
        ->type('enum')
        ->options(['user' => 'user', 'admin' => 'admin'])
        ->label('Rôle')
        ->validationRules('required');
        if ($membership) {
            CRUD::addField([
                'name' => 'membership_id',
                'label' => 'membership',
                'type' => 'enum',
                'options' => $users,
                'default' => $membership->membership_id,
            ]);
        } else {
            CRUD::addField([
                'name' => 'membership_id',
                'label' => 'membership',
                'type' => 'enum',
                'options' => $this->getAllMemberships(),
                'rules' => 'required',
            ]);
        }
        CRUD::field('has_Membership');
    }

    protected function getAllMemberships()
    {
        $memberships = membership::pluck('name', 'id')->toArray();
        return $memberships;
    }
}
