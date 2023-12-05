<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::get();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task;
        $task->mimeType = $request->file('task')->getMimeType();
        $task->originalName = $request->file('task')->getClientOriginalName();
        $task->path = $request->file('task')->store('tasks');
        $task->save();
        return view('tasks.create',
            ['id'=>$task->id,
            'path'=>$task->path,
            'originalName'=>$task->originalName,
            'mimeType'=>$task->mimeType]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task,$originalName='')
    {
        $task = Task::findOrFail($task->id);
        //dd($task);
        return response()->file(storage_path() . '/app/' . $task->path);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit',
            ['id'=>$task->id,
            'path'=>$task->path,
            'originalName'=>$task->originalName,
            'mimeType'=>$task->mimeType]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task = Task::findOrFail($task->id);
		Storage::delete($task->path);
		$task->originalName = request()->file('task')->getClientOriginalName();
		$task->path = request()->file('task')->store('tasks');
		$task->mimeType = $request->file('task')->getClientMimeType();
		$task->save();
		return back();//->with(['operation'=>'deleted','id'=>$task->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task = Task::findOrFail($task->id);
        Storage::delete($task->path);
        $task->delete();
        return back()->with(['operation'=>'deleted', 'id'=>$task->id]);
    }
}

