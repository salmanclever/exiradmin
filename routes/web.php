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
    CRUD::resource('group', 'GroupCrudController');
    CRUD::resource('categorie', 'CategorieCrudController');
});
