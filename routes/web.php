<?php
use App\Task;
use Illuminate\Http\Request;

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
    $task = Task::all();
    return View::make('welcome')->with('tasks', $task);
});

Route::get('/tasks/{task_id?}', function ($task_id){
    $task = Task::find($task_id);
    return Response::json($task);

});

Route::post('/tasks', function(Request $request){
    $task = Task::create($request->all());
    return Response::json($task);
});

Route::put('/tasks/{task_id?}', function (Request $request,$task_id){
    $task = Task::find($task_id);
    $task->task = $request->task;
    $task->description = $request->description;
    $task->done = $request->done;
    $task->save();
    return Response::json($task);
});

Route::delete('/tasks/{task_id}', function ($task_id){
    $task = Task::destroy($task_id);
    return Response::json($task);
});

Route::get('/foo', function()
{
    $dbCode = \Illuminate\Support\Facades\Artisan::call('key:generate');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('config:clear');
    $enterCode = \Illuminate\Support\Facades\Artisan::call('config:cache');
    return('Process completed successfully');
    //
});

Route::get('/bar', function()
{
    $exitCode = \Illuminate\Support\Facades\Artisan::call('migrate');
    return('Process completed successfully');
    //
});