<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;



class ProjectController extends Controller
{
        // NAAS AKONG PROJECTS.VUE AKONG FULL CRUD, SIR!!
        
    public function index() {
        $project = Project::orderBy('id')->get();

        return inertia('Projects', ['project' => $project]);
    }

    public function store(Request $request)
{
    $request->validate([
        'project_name' => 'required',
        'subject' => 'nullable',
    ]);

    Project::create($request->all());

    return redirect('/project');
}


    public function destroy($id) {
        $project = Project::find($id);
        $project->delete();
        return redirect('/project');
    }
}
