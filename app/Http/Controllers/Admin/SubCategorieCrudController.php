<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SubCategorieRequest;
use App\Models\Categorie;
use App\Models\SubCategorie;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SubCategorieCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SubCategorieCrudController extends CrudController
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
        CRUD::setModel(\App\Models\SubCategorie::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/sub-categorie');
        CRUD::setEntityNameStrings('sub categorie', 'sub categories');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('subCategoryName');
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
        CRUD::field('subCategoryName')->label('Nom de la sous-catégorie');

        CRUD::addField([
            'name' => 'category_id',
            'label' => 'Sous-catégorie',
            'type' => 'enum',
            'options' => $this->getAllSCategorys(),
            'rules' => 'required',
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }
    protected function getAllSCategorys()
    {
        $requests = Categorie::pluck('categoryName', 'id')->toArray();
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
        CRUD::field('subCategoryName')->label('Nom de la sous-catégorie');

        $currentId = $this->crud->getCurrentEntryId();
        $category = SubCategorie::find($currentId);

        CRUD::addField([
            'name' => 'category_id',
            'label' => 'Catégorie',
            'type' => 'enum',
            'options' => $this->getAllSCategorys(),
            'rules' => 'required',
            'default' => $category->category_id,
        ]);

    }
}
