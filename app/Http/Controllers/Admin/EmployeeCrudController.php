<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\EmployeeRequest as StoreRequest;
use App\Http\Requests\EmployeeRequest as UpdateRequest;
use App\Models\Group as Group;
use function PHPSTORM_META\type;

class EmployeeCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Employee');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/employee');
        $this->crud->setEntityNameStrings('نیرو', 'نیروها');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setFromDb();

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');

        $this->crud->addField([
            'name' => 'employee_id', // The db column name
            'label' => "شماره پرسنلی", // Table column heading

        ]);

        $this->crud->addField([
            'name' => 'username', // The db column name
            'label' => "نام کاربری", // Table column heading

        ]);
        $this->crud->addField([
            'name' => 'username', // The db column name
            'label' => "نام کاربری", // Table column heading

        ]);
$this->crud->addField([
    'name' => 'email', // The db column name
    'label' => "ایمیل", // Table column heading

        ]);
$this->crud->addField([
    'name' => 'password', // The db column name
    'label' => "کلمه عبور", // Table column heading

        ]);
$this->crud->addField([
    'name' => 'personal_id', // The db column name
    'label' => "کد ملی", // Table column heading

        ]);
$this->crud->addField([
    'name' => 'first_name', // The db column name
    'label' => "نام", // Table column heading

        ]);
$this->crud->addField([
    'name' => 'last_name', // The db column name
    'label' => " نام خانوادگی", // Table column heading

        ]);
$this->crud->addField([
    'name' => 'job_title', // The db column name
    'label' => " عنوان شغلی", // Table column heading

        ]);
$this->crud->addField([
    'name' => 'department', // The db column name
    'label' => "واحد", // Table column heading

        ]);
$this->crud->addField([
    'name' => 'tel', // The db column name
    'label' => "تلفن", // Table column heading

        ]);

        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS

        $this->crud->addColumn([
                'name' => 'id', // The db column name
                'label' => "انتخاب", // Table column heading
                'type' => 'checking'

            ]
        )->beforeColumn('employee_id'); // add a single column, at the end of the stack



        $this->crud->addColumn([
             'name' => 'employee_id', // The db column name
             'label' => "شماره پرسنلی", // Table column heading

             ]
            ); // add a single column, at the end of the stack

        $this->crud->addColumn([
                'name' => 'employee_id', // The db column name
                'label' => "شماره پرسنلی", // Table column heading

            ]
        ); // add a single column, at the end of the stack




                $this->crud->addColumn([
                'name' => 'username', // The db column name
                'label' => "نام کاربری", // Table column heading
            ]
        );
        $this->crud->addColumn([
                'name' => 'email', // The db column name
                'label' => "ایمیل", // Table column heading
            ]
        );
        $this->crud->addColumn([
                'name' => 'first_name', // The db column name
                'label' => "نام", // Table column heading
            ]
        );
        $this->crud->addColumn([
                'name' => 'last_name', // The db column name
                'label' => "نام خانوادگی", // Table column heading
            ]
        );

        $this->crud->addColumn([
                'name' => 'job_title', // The db column name
                'label' => "سمت شغلی", // Table column heading
            ]
        );

        $this->crud->addColumn([
                'name' => 'tel', // The db column name
                'label' => "تلفن", // Table column heading
            ]
        );



        $this->crud->addColumn([
                'name' => 'department', // The db column name
                'label' => "دپارتمان", // Table column heading
            ]
        );
        $this->crud->addColumn([
                'name' => 'personal_id', // The db column name
                'label' => "کد ملی", // Table column heading
            ]
        );



        
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // add multiple columns, at the end of the stack
         $this->crud->removeColumn('password'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
         $this->crud->setColumnDetails('employee_id', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);


        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();


        $this->crud->addFilter([ // simple filter
            'type' => 'text',
            'name' => 'email',
            'label'=> 'ایمیل'
        ],
            false,
            function($value) { // if the filter is active
                 $this->crud->addClause('where', 'email', 'LIKE', "%$value%");
            } );





    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }


    public function addEmployee($id)
    {
        $group = Group::findOrFail($id);

        $this->crud->hasAccessOrFail('list');

        $this->data['crud'] = $this->crud;
        $this->data['title'] = ucfirst($this->crud->entity_name_plural);
        $this->data['group_id'] = $id;
        $this->data['grouped_employee'] = $group->employees()->pluck('id');

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package

        return view($this->crud->getAddEmployeeView(), $this->data);
    }
}
