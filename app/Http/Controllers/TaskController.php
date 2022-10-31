<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function create()
    {
        $checks = Checklist::all();
        $ids = array();
        foreach ($checks as $check) {
            $value = array("id" => $check->id, 'name' => $check->checklist_name);
            array_push($ids, $value);
        }

        return view('adm.tasks.add', ['checks' => $checks, 'ids' => $ids]);
    }

    public function store(Request $request)
    {
        Task::create($request->all());
    }

    public function view($id)
    {
        $checklist = Checklist::where([
            ['id', $id],
        ])->first();

        $tasks = Task::where([
            ['checklist_id', $id],
        ])->get();

        return view('task', [
            'checklist' => $checklist,
            'tasks' => $tasks,
        ]);
    }

    public function delete($id, Request $request)
    {
        Task::findOrFail($id)->delete();
    }
}
