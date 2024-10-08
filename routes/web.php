<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

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
    return redirect()->route('task.index');
});

Route::get('/tasks', function (Task $task) {
    return view('index', [
        'tasks' => $task::latest()->paginate(10),
    ]);
})->name('task.index');

Route::view('/tasks/create', 'create')
    ->name('task.create');

Route::get('tasks/{task}', function (Task $task) {
    return view('show', ['task' => $task]);
})->name('task.show');

Route::get('tasks/{task}/edit', function (Task $task) {
    return view('edit', ['task' => $task]);
})->name('task.edit');

Route::post('/tasks', function (Task $task, TaskRequest $request) {

    // $data = $request->validated();
    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task = Task::create($request->validated());

    return redirect()->route('task.show', ['task' => $task->id])
    ->with('success','Task created successfully!');
})->name('task.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());

    return redirect()->route('task.show', ['task' => $task->id])
    ->with('success','Task Updated successfully!');
})->name('task.update');

Route::delete('/task/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('task.index')
    ->with('success','Task deleted successfully.');
})->name('task.destroy');

Route::put('tasks/{task}/toggle-complete}', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully');
})->name('task.toggle-complete');


Route::fallback(function () {
    return 'Does not exist';
});
