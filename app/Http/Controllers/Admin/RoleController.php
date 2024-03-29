<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('can:admin.roles.index')->only('index');
		$this->middleware('can:admin.roles.create')->only('create', 'store');
		$this->middleware('can:admin.roles.show')->only('show');
		$this->middleware('can:admin.roles.edit')->only('edit', 'update');
		$this->middleware('can:admin.roles.destroy')->only('destroy');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$roles = Role::orderBy('id', 'DESC')->paginate(5);

		return view('admin.roles.index', compact('roles'))
			->with('i', ($request->input('page', 1) - 1) * 5);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$permission = Permission::get();
		$role = new Role();

		return view('admin.roles.create', compact('permission', 'role'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|unique:roles,name',
			'permission' => 'required',
		]);

		$role = Role::create(['name' => $request->input('name')]);
		$role->syncPermissions($request->input('permission'));

		return redirect()->route('admin.roles.index')
						->with('success', 'Role created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$role = Role::find($id);
        $rolePermissions = Role::findByName($role->name)->permissions;
		// $rolePermissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
		// 	->where('role_has_permissions.role_id', $id)
		// 	->get();

		return view('admin.roles.show', compact('role', 'rolePermissions'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$role = Role::find($id);
        $permission = Permission::all();
        $rolePermissions = Role::findByName($role->name)->permissions;

		// $permission = Permission::get();
		// $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)
		// 	// ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
		// 	->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
		// 	->all();

		return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'name' => 'required',
			'permission' => 'required',
		]);

		$role = Role::find($id);
		$role->name = $request->input('name');
		$role->save();

		$role->syncPermissions($request->input('permission'));

		return redirect()->route('admin.roles.index')
						->with('success', 'Role updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		DB::table('roles')->where('id', $id)->delete();

		return redirect()->route('admin.roles.index')
						->with('success', 'Role deleted successfully');
	}
}
