<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function tasksView() {
        $tasks = Task::orderBy('priority','asc')->get();
        $projects = Project::all();
        $data = array(
            'tasks' => $tasks,
            'projects' => $projects
        );
        return view('tasks', compact('data'));
    }

    public function tasksRun(Request $request) {
        $name = $request->input('name');
        $project_id = $request->input('project_id');
        $priority = $request->input('priority');
        $validated = $request->validate([
            'name' => 'required|min:3|max:100',
            'project_id' => 'required|numeric',
            'priority' => 'required|numeric',
        ]);

        $check = Task::where('priority', $priority)->first();
        if($check) {
            //priority already set for another task; inform user
            return back()->with('err_msg', 'This priority is already added to another task. Please try another.');
        }
        else {
            $task = new Task;
            $task->name = Str::title($name);
            $task->project_id =$project_id;
            $task->priority = $priority;
            $task->status = 1;
            if($task->save()) {
                return back()->with('suc_msg', 'Task added successfully.');
            }
            else {
                return back()->with('err_msg', 'Task could not be added. Please try again.');
            }
        }
    }

    public function tasksUpdate(Request $request) {
        if($request->input('action') == 'edit') {
            $name = $request->input('name');
            $project_id = $request->input('project_id');
            $priority = $request->input('priority');
            $task_id = $request->input('task_id');

            $validated = $request->validate([
                'name' => 'required|min:3|max:100',
                'priority' => 'required|numeric|unique:tasks,priority,'.$task_id,
            ],
            [
                'priority.unique' => 'The priority '.$priority.' has been added to another task. Use another.'
            ]
            );

            $update = Task::where('id', $task_id)->update(['name' => $name, 'project_id' => $project_id, 'priority' => $priority]);
            if($update) {
                return back()->with('suc_msg', 'Task updated successfully.');
            }
            else {
                return back()->with('err_msg', 'Task could not be updated. Please try again.');
            }
        }
        elseif($request->input('action') == 'delete') {
            $task_id = $request->input('task_id');

            $update = Task::where('id', $task_id)->delete();
            if($update) {
                return back()->with('suc_msg', 'Task deleted successfully.');
            }
            else {
                return back()->with('err_msg', 'Task could not be deleted. Please try again.');
            }
        }
    }

    public function tasksUpdateOrder(Request $request){
        foreach ($request->priority as $key => $priority) {
            $task = Task::find($priority['id'])->update(['priority' => $priority['priority']]);
        }
        return response()->json(['status' => 'success']);
    }


}
