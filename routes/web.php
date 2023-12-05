<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks/create', [TaskController::class, 'create']);

use Illuminate\Http\Request;

//file task submission with post
Route::post('tasks', function (Request $request){
    sleep(15);
    dd($request->task);
    $task = $request->task;
    $mime = $task->getMimeType();
    $originalName = $task->getClientOriginalName();
    $path = $task->store('tasks');
    return view('tasks',
    ['path'=>$path,'originalName'=> $originalName,'mime'=>$mime]);
});



Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit']);

Route::get('/tasks/{task}/{originalName?}', [TaskController::class, 'show']);

Route::get('/tasks', [TaskController::class, 'index']);

Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);

Route::put('/tasks/{task}', [TaskController::class, 'update']);