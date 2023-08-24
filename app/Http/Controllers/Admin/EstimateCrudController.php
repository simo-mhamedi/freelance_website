<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EstimateRequest;
use App\Models\Estimate;
use App\Models\Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Foundation\Auth\User;

/**
 * Class EstimateCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EstimateCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Estimate::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/estimate');
        CRUD::setEntityNameStrings('estimate', 'estimates');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('reference');
        CRUD::column('request_id');
        CRUD::column('user_id');
        CRUD::column('estimate_date');
        CRUD::column('rating');
        CRUD::column('file');
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
        $options = function () {
            return Request::pluck('title', 'id')->toArray();
        };


        CRUD::addField([
            'name' => 'request_id',
            'label' => 'Demande',
            'type' => 'enum',
            'options' => $options(),
            'allows_null' => true,
            'rules' => ['required'],
        ]);

        CRUD::addField([
            'name' => 'freelancer_id',
            'label' => 'Freelancer',
            'type' => 'enum',
            'options' => $this->getAllUsers(),
            'rules' => 'required',
        ]);

        CRUD::addField([
            'name' => 'client_id',
            'label' => 'Client',
            'type' => 'enum',
            'options' => $this->getAllUsers(),
            'rules' => 'required',
        ]);

        CRUD::field('estimate_date')->label('Date d\'estimation')->validationRules('required');
        CRUD::field('rating')->label('Évaluation')->validationRules('required');

        CRUD::addField([
            'name' => 'file',
            'label' => 'Fichier',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
        ]);

    }
    protected function getAllUsers()
    {
        $users = User::pluck('email', 'id')->toArray();
        return $users;
    }
    protected function getAllRequests()
    {
        $requests = Request::pluck('title', 'id')->toArray();
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
        $users = User::pluck('email', 'id')->toArray();
        $estimate = Estimate::find($currentId);
        $requests =$this->getAllRequests();
        CRUD::field('reference')->label('Référence');
        CRUD::field('request_id')->label('ID de demande');
        CRUD::addField([
            'name' => 'request_id',
            'label' => 'Demande',
            'type' => 'enum',
            'options' => $requests,
            'default' => $estimate->request_id,
        ]);
        CRUD::addField([
            'name' => 'freelancer_id',
            'label' => 'Freelancer',
            'type' => 'enum',
            'options' => $this->getAllUsers(),
            'rules' => 'required',
        ]);

        CRUD::addField([
            'name' => 'client_id',
            'label' => 'Client',
            'type' => 'enum',
            'options' => $this->getAllUsers(),
            'rules' => 'required',
        ]);
        CRUD::field('estimate_date')->label('Date d\'estimation');
        CRUD::field('rating')->label('Évaluation');

        CRUD::addField([
            'name' => 'file',
            'label' => 'Fichier',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
        ]);
    }
}
