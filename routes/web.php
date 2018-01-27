<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function()
{
   CRUD::resource('employee', 'EmployeeCrudController');
   CRUD::resource('department', 'DepartmentCrudController');
    CRUD::resource('group', 'GroupCrudController')->with(function (){
        Route::get('group/{id}/addemployee', 'EmployeeCrudController@addEmployee');
        Route::post('group/{id}/addemployee', 'GroupCrudController@addEmployee');

    });
    CRUD::resource('categorie', 'CategorieCrudController')->with(function (){
        Route::get('categorie/{id}/addgroup', 'GroupCrudController@addGroup');
        Route::post('categorie/{id}/addgroup', 'GroupCrudController@addGroup');
    });

    CRUD::resource('poll', 'PollCrudController');
});
