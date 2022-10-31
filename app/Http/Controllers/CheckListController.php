<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCheckList;
use App\Models\Checklist;
use App\Models\Task;
use Illuminate\Http\Request;

 
class ChecklistController extends Controller
{

    public function updateProgress(){
        $finalizados = Task::with('checklist')
        ->where('task_status', 1)
        ->get();
         
        $checks_id = array();

        for ($i=0; $i < $finalizados->count(); $i++) {
            $check_id = $finalizados[$i]->checklist_id;
            array_push($checks_id, $check_id);
        }

        for ($i=0; $i < count($checks_id); $i++) { 
            $checks_with_tasks = Checklist::with('tasks')
            ->where('id', $checks_id[$i])
            ->get();

            $porcentagem = (100 / $checks_with_tasks[0]->tasks->count());

            Checklist::query()
            ->where('id', $checks_id[$i])
            ->update([
                'progress' => $porcentagem,
            ]);
        }
    }

    public function index()
    {
        $user = auth()->user();

        $search = request('search');
        
        if($search)
        {
            $checks = Checklist::where([
                ['checklist_name', 'like', '%'.$search.'%']
            ])->get();
        }else {
            $checks = Checklist::all();
        }

        $this->updateProgress();

        return view('welcome', [
            'user' => $user,
            'checks' => $checks,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('adm.checklists.add');
    }

    public function store(PostCheckList $request)
    {
        $validate = $request->validated(PostCheckList::class);

        if(!$validate){
            Checklist::create([
                'checklist_name' => strtoupper($request->checklist_name),
            ]);
        }
    }

    public function edit($id)
    {
        $check = Checklist::findOrFail($id);

        return view('adm.checklists.edit', [
            'check' => $check,
        ]);
    }

    public function update($id, Request $request)
    {
        Checklist::findOrFail($id)->update([
            'checklist_name' => strtoupper($request->checklist_name)
        ]);
    }

    public function delete($id, Request $request)
    {
        Task::with('checklist')
        ->where('checklist_id', $id)
        ->delete();

        Checklist::findOrFail($id)
        ->delete();
    }
}
