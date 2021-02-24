<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Facades\Datatables;

class UserController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('can:admin.users.index')->only('index');
		$this->middleware('can:admin.users.create')->only('create', 'store');
		$this->middleware('can:admin.users.show')->only('show');
		$this->middleware('can:admin.users.edit')->only('edit', 'update');
		$this->middleware('can:admin.users.destroy')->only('destroy');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = User::all();

			return Datatables()->of($data)
				->addColumn('role', function ($user) {
					$roleBadge = '';
					if (!empty($user->getRoleNames())):
						foreach ($user->getRoleNames() as $v):
							if ($v == 'Admin'):
								$roleBadge .= ' <label class="badge badge-danger">' . $v . '</label>'; else:
								$roleBadge .= ' <label class="badge badge-success">' . $v . '</label>';
					endif;
					endforeach;
					endif;

					return $roleBadge;
				})
				->addColumn('action', function ($user) {
					$actionBtn = '
                        <div class="btn-group">
                            <a href="' . route('admin.users.show', $user->id) . '" class="btn btn-info">Ver</a>
                            <a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-warning">Modificar</a>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="' . $user->id . '">Eliminar</button>
                        </div>
                    ';

					return $actionBtn;
				})
				->rawColumns(['action', 'role'])
				->editColumn('created_at', function (User $user) {
					return $user->created_at->diffForHumans();
				})
				->only(['id', 'name', 'last_name', 'email', 'role', 'created_at', 'action'])
				->make(true);
		} else {
			$users = User::orderBy('id', 'desc')->paginate('5');

			return view('admin.users.index', compact('users'));
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$roles = Role::pluck('name', 'name')->all();
		$user = new User();

		return view('admin.users.create', compact('roles', 'user'));
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
			'name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|same:password_confirmation',
			'roles' => 'required',
		]);

		$input = $request->all();
		$input['password'] = Hash::make($input['password']);

		$user = User::create($input);
		$user->assignRole($request->input('roles'));

		return redirect()->route('admin.users.index')
						->with('success', 'User created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);

		return view('admin.users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);
		$roles = Role::pluck('name', 'name')->all();
		$userRole = $user->roles->pluck('name', 'name')->all();

		return view('admin.users.edit', compact('user', 'roles', 'userRole'));
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
			'last_name' => 'required',
			'email' => 'required|email|unique:users,email,' . $id,
			'password' => 'same:password_confirmation',
			'roles' => 'required',
		]);

		$input = $request->all();
		if (!empty($input['password'])) {
			$input['password'] = Hash::make($input['password']);
		} else {
			$input = Arr::except($input, ['password']);
		}

		$user = User::findOrFail($id);
		$user->update($input);
		DB::table('model_has_roles')->where('model_id', $id)->delete();

		$user->assignRole($request->input('roles'));

		return redirect()->route('admin.users.index')
						->with('success', 'User updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user)
	{
		if ($user->id == \Auth::id()) {
			return redirect()->route('admin.users.index')
							->with('error', 'You cannot delete yourself');
		}
		if ($user->id != 1) {
			User::findOrFail($user->id)->delete();

			return redirect()->route('admin.users.index')
									->with('success', 'User deleted successfully');
		}
		if (\Auth::user()->hasRole('Admin')) {
			return redirect()->route('admin.users.index')
							->with('error', 'You cannot delete Admin');
		}
	}
}
