<?php


use App\Http\Controllers\crudcontroller;
use App\Http\Controllers\mailController;
use Illuminate\Support\Facades\Route;
use App\Models\Usertwo;

// Route::get('',[crudcontroller::class,'']);
Route::get('users',[crudcontroller::class,'users']);

Route::get('/',[crudcontroller::class,'home']);
Route::get('about',[crudcontroller::class,'about']);
Route::get('contact',[crudcontroller::class,'contact']);

//insert
Route::get('insert',[crudcontroller::class,'insert']);

Route::post('insert',[crudcontroller::class,'insert'])->name('insert');
Route::post('insert2',[crudcontroller::class,'insert2']);
Route::post('/update_form',[crudcontroller::class,'update_form']);
Route::delete('/delete_user',[crudcontroller::class,'delete_user']);
Route::post('/get_user_by_id',[crudcontroller::class,'get_user_by_id']);
Route::post('/courses_data',[crudcontroller::class,'get_courses_data']);
Route::get('/mail_me',[mailController::class,'mailFun']);



