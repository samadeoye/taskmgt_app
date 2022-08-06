<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function projectsView() {
        $projects = Project::all();
        return view('projects', compact('projects'));
    }

    public function projectsRun(Request $request) {
        $title = $request->input('title');
        $validated = $request->validate([
            'title' => 'required|min:3|max:100'
        ]);
        $project = new Project;
        $project->title = Str::title($title);
        $project->status = 1;
        if($project->save()) {
            return back()->with('suc_msg', 'Project added successfully.');
        }
        else {
            return back()->with('err_msg', 'Project could not be added. Please try again.');
        }
    }

    public function projectsUpdate(Request $request) {
        if($request->input('action') == 'edit') {
            $title = $request->input('title');
            $project_id = $request->input('project_id');

            $validated = $request->validate([
                'title' => 'required|min:3|max:100'
            ]);
            $update = Project::where('id', $project_id)->update(['title' => $title]);
            if($update) {
                return back()->with('suc_msg', 'Project updated successfully.');
            }
            else {
                return back()->with('err_msg', 'Project could not be updated. Please try again.');
            }
        }
        elseif($request->input('action') == 'delete') {
            $project_id = $request->input('project_id');

            $update = Project::where('id', $project_id)->delete();
            if($update) {
                return back()->with('suc_msg', 'Project deleted successfully.');
            }
            else {
                return back()->with('err_msg', 'Project could not be deleted. Please try again.');
            }
        }
        
    }
}
