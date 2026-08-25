<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            // VULNERABLE: SQL Injection
            $projects = DB::select("SELECT * FROM projects WHERE name LIKE '%$search%' OR description LIKE '%$search%' OR client_name LIKE '%$search%'");
            return view('projects.index', ['projects' => $projects]);
        }

        $projects = Project::where('created_by', auth()->id())->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_name' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:active,completed,on_hold',
        ]);

        $validated['created_by'] = auth()->id();
        $project = Project::create($validated);

        return redirect()->route('projects.show', $project)->with('success', 'Project created.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function storeComment(Request $request, Project $project)
    {
        $comment = new ProjectComment();
        $comment->project_id = $project->id;
        $comment->user_id = auth()->id();
        $comment->comment = $request->input('comment');
        $comment->save();

        return back()->with('success', 'Comment added.');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $project->update($request->all());
        return redirect()->route('projects.show', $project)->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted.');
    }
}