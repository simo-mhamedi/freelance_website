<?php

namespace App\Http\Controllers\Admin\Operations;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;

trait TstOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupTstRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/tst', [
            'as'        => $routeName.'.tst',
            'uses'      => $controller.'@tst',
            'operation' => 'tst',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupTstDefaults()
    {
        CRUD::allowAccess('tst');

        CRUD::operation('tst', function () {
            CRUD::loadDefaultOperationSettingsFromConfig();
        });

        CRUD::operation('list', function () {
            // CRUD::addButton('top', 'tst', 'view', 'crud::buttons.tst');
            // CRUD::addButton('line', 'tst', 'view', 'crud::buttons.tst');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function tst()
    {
        CRUD::hasAccessOrFail('tst');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = CRUD::getTitle() ?? 'Tst '.$this->crud->entity_name;

        // load the view
        return view('crud::operations.tst', $this->data);
    }
}