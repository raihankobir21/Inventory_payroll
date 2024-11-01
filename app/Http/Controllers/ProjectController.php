<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Company;
use App\Models\MyCompany;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('company')->paginate(10); // Adjust the per-page number as needed
        return view('projects.index', compact('projects'));
    }
    

    public function create()
    {
        $companies = Company::all();
        return view('projects.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
		
            'company' => 'required|integer|exists:companies,id',
            //'project_custom_id' => 'required|string|max:30|unique:projects',
            'name' => 'required',
            'description' => 'required',
			
        ]);
		
		$input = $request->all();
		//dd($input);

		$myCompanyInfo = MyCompany::first();
		
		$companySName = '';
		
		if( !empty( $myCompanyInfo) )
		{
			$companySName = $myCompanyInfo->short_name;
			
		}else{
			
			 return redirect()->route('projects.index')->with('error', 'Please create your company information.');
  
		}
		$currentDM =  date('YM');
		
		$project = Project::where('project_custom_id', 'LIKE', "%{$currentDM}%")
					->orderBy('id', 'desc')
					->first();
		
		//dd( );
		
		if( !empty($project) )
		{
			$projectId = substr($project->project_custom_id, strpos($project->project_custom_id, "-") + 1);
			$projectId = $companySName.$currentDM.'-'.($projectId+1);
			
		}else{
			
			$projectId  = $companySName.$currentDM.'-1';
		}
		
		//dd($myCompanyInfo->toArray() );
		
		$input['company_id'] = $input['company'];
		
		
		//$input['project_custom_id'] = $projectId;
		
		
		
        Project::create( $input );
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $companies = Company::all();
        return view('projects.edit', compact('project', 'companies'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'company_id' => 'required|integer|exists:companies,id',
            'project_custom_id' => 'required|string|max:30|unique:projects,project_custom_id,' . $project->id,
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|integer'
        ]);

        $project->update($request->all());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
