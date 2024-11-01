<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
    
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $roles = Role::orderBy('order','ASC')->paginate(10);
		
        return view('roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
       $permission = Permission::get()->toArray();
		
		
		$reArrangePermission = [];
		foreach( $permission as $p )
		{
			$reArrangePermission[$p['section_name']][$p['id']] = $p['name'];
		}
		
        return view('roles.create',compact('reArrangePermission'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $totalLength = Role::count();
		$this->validate($request, [
           'name' => 'required|unique:roles,name',

            'permission' => 'required',
			
			'order' => 'required|numeric|gt:0|lt:'.$totalLength+2,
        ]);
		
		$dropdownShow = 1;
		if ( empty($request->input('dropdown_show') ) )
		{
			$dropdownShow = 0;
		}

        $permissionsID = array_map(
            function($value) { return (int)$value; },
            $request->input('permission')
        );
    
        //$role = Role::create(['name' => $request->input('name')]);
		$role = Role::create(['name' => $request->input('name'), 'dropdown_show' => $dropdownShow, 'order' => $request->input('order'), 'create_type' => 1]);

        $role->syncPermissions($permissionsID);
		
		$updateOrder = Role::select('id', 'order')
			->where('order', '>=', $request->input('order'))
			->where( 'id', '!=', $role->id )
			->orderBy('order', 'asc')
			->get();
		
		//dd( $updateOrder->toArray() );
		
		//$totalLength = sizeof($updateOrder);
			
			//dd($updateOrder->toArray());
			$updateValue = ($request->input('order')+1);
			foreach($updateOrder as $v)
			{
				
				$orderInpur['order'] = $updateValue++;
				//dd($orderInpur);
				$orderUpdate = Role::find( $v->id );
				$orderUpdate->update($orderInpur);
				//dd($v->id);
			}
			
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('roles.show',compact('role','rolePermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        /*$role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.edit',compact('role','permission','rolePermissions'));
    */
	
	
	 $role = Role::find($id);

        $permission = Permission::get();

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)

            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')

            ->all();
		
		$reArrangePermission = [];
		foreach( $permission as $p )
		{
			$reArrangePermission[$p['section_name']][$p['id']] = $p['name'];
		}
		
        return view('roles.edit',compact('reArrangePermission', 'role','permission','rolePermissions'));

	
	
	}
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
       $totalLength = Role::count();
	   
	   $this->validate($request, [
            'name' => 'required',
			'order' => 'required|numeric|gt:0|lt:'.$totalLength+1,
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
		$role = Role::find($id);
		
		$role->dropdown_show = 1;
		if ( empty($request->input('dropdown_show') ) )
		{
			$dropdownShow = 0;
			$role->dropdown_show = 0;
		}
		
		$oldOrder = $role->order;
		
        $newOrder  = $request->input('order');
		
		if( $role->create_type == 1 )
		{
			$role->name = $request->input('name');
        }
		$role->order = $newOrder;
		
        $role->name = $request->input('name');
        $role->save();
		
		if( $newOrder > $oldOrder )
		{
			$updateOrder = Role::select('id', 'order')
				->where('order', '>',   $oldOrder )
				->where('order', '<=',   $newOrder )
				->where('id', '!=', $id )
				->orderBy('order', 'asc')->get();
				
			//dd($updateOrder->toArray());	
				
			$updateValue = $oldOrder;
			foreach($updateOrder as $v)
			{
				//dd($updateValue);
				
				$orderInput['order'] = $updateValue++;
				//dd($orderInput);
				$orderUpdate = Role::find( $v->id );
				$orderUpdate->update($orderInput);
				
			}
				
		}else{
			
			$updateOrder = Role::select('id', 'order')
				->where('order', '>=', $request->input('order'))
				->where('id', '!=', $id )
				->orderBy('order', 'asc')->get();
				
			$updateValue = ($request->input('order')+1);
			foreach($updateOrder as $v)
			{
				//dd($updateValue);
				
				$orderInput['order'] = $updateValue++;
				//dd($orderInput);
				$orderUpdate = Role::find( $v->id );
				$orderUpdate->update($orderInput);
				
			}
		}
		// end update other row ordering

        $permissionsID = array_map(
            function($value) { return (int)$value; },
            $request->input('permission')
        );
    
        $role->syncPermissions($permissionsID);
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}