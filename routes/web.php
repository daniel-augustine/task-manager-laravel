<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Response;

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

// class Task
// {
//     public function __construct(
//         public int $id,
//         public string $title,
//         public string $description,
//         public ?string $long_description,
//         public bool $completed,
//         public string $created_at,
//         public string $updated_at
//     ) {
//     }
// }

// $tasks = [
//     new Task(
//         1,
//         'Buy groceries',
//         'Task 1 description',
//         'Task 1 long description',
//         false,
//         '2023-03-01 12:00:00',
//         '2023-03-01 12:00:00'
//     ),
//     new Task(
//         2,
//         'Sell old stuff',
//         'Task 2 description',
//         null,
//         false,
//         '2023-03-02 12:00:00',
//         '2023-03-02 12:00:00'
//     ),
//     new Task(
//         3,
//         'Learn programming',
//         'Task 3 description',
//         'Task 3 long description',
//         true,
//         '2023-03-03 12:00:00',
//         '2023-03-03 12:00:00'
//     ),
//     new Task(
//         4,
//         'Take dogs for a walk',
//         'Task 4 description',
//         null,
//         false,
//         '2023-03-04 12:00:00',
//         '2023-03-04 12:00:00'
//     ),
// ];

Route::get('/', function () {
    return redirect()->route('tasks.index');
});


Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');



// Route::get('/tasks', function () use ($tasks) {
//     return view('index', [
//         // 'name'=>'Dani'
//         'tasks' => $tasks
//     ]);
// })->name('tasks.index');
Route::get('/tasks', function () {
    return view('index', [
        // 'name'=>'Dani'
        // 'tasks' => Task::latest()->get()//->where('completed',true)
        'tasks' => Task::latest()->paginate()
    ]);
})->name('tasks.index');

// Route::get('/tasks/{id}', function ($id) use ($tasks) {
//     // return "single task";
//     $task = collect($tasks)->firstWhere('id', $id);
//     if (!$task) {
//         abort(Response::HTTP_NOT_FOUND);
//     }
//     return view('show', ['task' => $task]);
// })->name('task.show');


Route::view('/tasks/create','create')
    ->name('tasks.create');



Route::get('/tasks/{task}', function (Task $task) {
    return view('show', ['task' => $task]);
})->name('task.show');

// Route::get('/hello', function () {
//     return "helloo";
// })->name("hello");

// Route::get(
//     '/hi',
//     function () {
//         return redirect()->route("hello");
//     }
// );


Route::post('tasks', function(TaskRequest $request){
    // dd('we have reached');
    // dd($request->all());
    // $data = $request->validate([
    //     'title'=>'required|max:255',
    //     'description' => 'required',
    //     'long_description' => 'required',
    // ]);


    // $data = $request->validated();
    // $task = new Task();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task = Task::create($request->validated());
    return redirect()->route('task.show', ['task'=>$task->id])
    ->with('success', 'Task created successfully');
})->name('tasks.store');


Route::put('tasks/{task}', function(Task $task, TaskRequest $request){
    // dd('we have reached');
    // dd($request->all());
    // $data = $request->validate([
    //     'title'=>'required|max:255',
    //     'description' => 'required',
    //     'long_description' => 'required',
    // ]);
    // $task = Task::findOrFail($id);


    // $data = $request->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task->update($request->validated());

    return redirect()->route('task.show', ['task'=>$task->id])
    ->with('success', 'Task updated successfully');
})->name('tasks.update');

// Route::delete('tasks/{task}', function(Task $task){
//     $task->delete();
//     return redirect()->route('tasks.index')
//         ->with('success', 'Task deleted successfully');
// })->name('tasks.destroy');
Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete',function(Task $task){
    $task->toggleComplete();
    return redirect()->back()->with('success','Task updated successfully');
})->name('tasks.toggle');


Route::fallback(function () {
    return "Somewhere else";
});
