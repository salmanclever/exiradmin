<?php

namespace App\Http\Controllers\Admin;

use App\Models\Poll;
use App\Pollanswer;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PollRequest as StoreRequest;
use App\Http\Requests\PollRequest as UpdateRequest;
use http\Env\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PollCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Poll');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/poll');
        $this->crud->setEntityNameStrings('نظر سنجی', 'نظر سنجی ها');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setFromDb();

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        $this->crud->addField([
            'name' => 'name',
            'label' => "عنوان نظر سنجی :",
            'type' => 'text',

            // optional
            //'prefix' => '',
            //'suffix' => '',
            //'default'    => 'نام نظرسنجی ...', // default value
            //'hint'       => 'نام نظرسنجی ...', // helpful text, show up after input
            //'attributes' => [
            'placeholder' => 'نام نظرسنجی ...',
            //'class' => 'form-control some-class'
            //], // extra HTML attributes and values your input might need
            //'wrapperAttributes' => [
            //'class' => 'form-group col-md-12'
            //], // extra HTML attributes for the field wrapper - mostly for resizing fields
            //'readonly'=>'readonly',
            'tab' => 'اطلاعات اصلی',
        ]);
        $this->crud->addField([
            // Textarea
            'name' => 'question',
            'label' => 'سوال نظرسنجی :',
            'type' => 'textarea',
            'tab' => 'اطلاعات اصلی',
        ]);
        $this->crud->addField([
            'name'        => 'status', // the name of the db column
            'label'       => 'وضعیت :', // the input label
            'type'        => 'radio',
            'options'     => [ // the key will be stored in the db, the value will be shown as label;
                0 => "فعال",
                1 => "غیر فعال"
            ],
            'before' => 'vote_type',
            // optional
            'inline'      => true, // show the radios all on the same line?
            'tab' => 'اطلاعات اصلی',
        ]);

        $this->crud->addField([
            'name'        => 'vote_type', // the name of the db column
            'label'       => 'نوع نظر سنجی :', // the input label
            'type'        => 'radio',
            'options'     => [ // the key will be stored in the db, the value will be shown as label;
                0 => "رادیویی",
                1 => "چک باکس"
            ],
            'before' => 'cookie_restricted',
            // optional
            'inline'      => true, // show the radios all on the same line?
            'tab' => 'تنظیمات',
        ])->beforeField('ip_restricted');

        $this->crud->addField( [
                'name' => 'timestamp', // a unique name for this field
                'start_name' => 'start_date', // the db column that holds the start_date
                'end_name' => 'end_date', // the db column that holds the end_date
                'label' => 'بازه زمانی :',
                'type' => 'date_range',
                // OPTIONALS
                'start_default' => Carbon::now(), // default value for start_date
                'end_default' => (Carbon::now()), // default value for end_date
                'date_range_options' => [ // options sent to daterangepicker.js
                    'timePicker' => true,
                    'locale' => ['format' => 'DD/MM/YYYY HH:mm']
                ],
            'tab' => 'اطلاعات اصلی',
            ])->beforeField('public');








        $this->crud->addField([
            'name' => 'show_results',
            'label' => 'نتایج نظرسنجی برای کاربران نمایش داده شود؟',
            'type' => 'checkbox',
            'tab' => 'تنظیمات',
        ]);
        $this->crud->addField([
            'name' => 'ip_restricted',
            'label' => 'محدودیت رای دهی توسط آیپی ! هر کاربر تنها توسط یک آیپی بتواند رای خود را ثبت کند',
            'type' => 'checkbox',
            'tab' => 'تنظیمات',
        ]);
        $this->crud->addField([
            'name' => 'cookie_restricted',
            'label' => 'محدودیت رای دهی توسط کوکی بروزر کاربر',
            'type' => 'checkbox',
            'tab' => 'تنظیمات',
        ])->beforeField('ip_restricted');

        $this->crud->addField([
            'name' => 'user_restricted',
            'label' => 'کاربر برای رای دهی الزاما باید لاگین کند!',
            'type' => 'checkbox',
            'tab' => 'تنظیمات',
        ])->beforeField('cookie_restricted');

        $this->crud->addField([ // select_from_array
            'name' => 'theme_id',
            'label' => "قالب نظر سنجی :",
            'type' => 'select_from_array',
            'options' => [1 => 'آبی' , 2 => 'قرمز'],
            'allows_null' => false,
            'tab' => 'تنظیمات',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
        ]);

        $this->crud->addField([
            'name'        => 'public', // the name of the db column
            'label'       => 'دسترسی  :', // the input label
            'type'        => 'radio',
            'options'     => [ // the key will be stored in the db, the value will be shown as label;
                0 => "عمومی",
                1 => "اختصاصی"
            ],
            // optional
            'inline'      => true, // show the radios all on the same line?
            'tab' => 'تنظیمات',
        ]);

        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');
        $this->crud->removeFields([
            'user_id',
            'start_date',
            'end_date',
            'votes',
          ]);

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        $this->crud->addColumn(
            [
                'name' => 'name', // The db column name
                'label' => "نام نظر سنجی" // Table column heading
            ]
        ); // add a single column, at the end of the stack
        $this->crud->addColumn(
            [
                'name' => 'start_date', // The db column name
                'label' => "تاریخ شروع" // Table column heading
            ]
        );

        $this->crud->addColumn(
            [
                'name' => 'end_date', // The db column name
                'label' => "تاریخ پایان" // Table column heading
            ]
        );
        $this->crud->addColumn(
            [
                'name' => 'status',
                'label' => "وضعیت",
                'type' => 'select_from_array',
                'options' => [0 => 'فعال', 1 => 'غیر فعال'],
            ]
        );

        $this->crud->addColumn(
            [
                'name' => 'votes', // The db column name
                'label' => "تعداد آراء" // Table column heading
            ]
        );

        $this->crud->addColumn(
            [
                'name' => 'public',
                'label' => "دسترسی",
                'type' => 'select_from_array',
                'options' => [0 => 'عمومی', 1 => 'اختصاصی'],
            ]
        );

        $this->crud->addColumn([
            // 1-n relationship
            'label' => "ایجاد شده توسط", // Table column heading
            'type' => "select",
            'name' => 'user_id', // the column that contains the ID of that connected entity;
            'entity' => 'users', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\User", // foreign key model
        ]);

        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        $this->crud->removeColumn('question');
        $this->crud->removeColumn('show_results');
        $this->crud->removeColumn('ip_restricted');
        $this->crud->removeColumn('vote_type');
        $this->crud->removeColumn('theme_id');
        $this->crud->removeColumn('user_restricted');
        $this->crud->removeColumn('cookie_restricted');
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
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

        $this->crud->addButtonFromView('line', 'add_answer', 'addanswer', 'beginning'); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons


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

    public function index()
    {

        $this->crud->hasAccessOrFail('list');

        $this->data['crud'] = $this->crud;
        $this->data['title'] = ucfirst($this->crud->entity_name_plural);


        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view('vendor.backpack.crud.poll.poll',$this->data);

    }

    public function create()
    {
        $this->crud->hasAccessOrFail('create');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['saveAction'] = $this->getSaveAction();
        $this->data['fields'] = $this->crud->getCreateFields();
        $this->data['title'] = trans('backpack::crud.add').' '.$this->crud->entity_name;

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view('vendor.backpack.crud.poll.create', $this->data);
    }

    public function addAnswer($id){
        $this->crud->hasAccessOrFail('create');
        $poll = Poll::findOrFail($id);
        $answers = $poll->answer()->get();
        $answerscount = Pollanswer::All()->count();
        $this->data['pollAnswer'] = $answers;

        $this->data['pollAnswerCount'] = $answerscount;

        return view('vendor.backpack.crud.poll.addanswer', $this->data);
    }

    public function storeAnswer($pollid){
            $answer = new Pollanswer;
            $poll = Poll::findOrFail($pollid);
            $answer->answer = Input::get('answer');

        $res = $poll->answer()->save($answer);

//
           //$res = $poll->save();
        return $res;
    }

    public function deleteAnswer(){
        $answer = Pollanswer::findOrFail(Input::get('answer'));
       $answer->polls()->dissociate();
        $res = $answer->save();
        $res = ($res)?"true":"false";
        return $res;
    }
}
