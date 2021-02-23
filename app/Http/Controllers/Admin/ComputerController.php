<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComputerRequest;
use App\Models\Computer;

class ComputerController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('can:admin.computers.index')->only('index');
		$this->middleware('can:admin.computers.create')->only('create', 'store');
		$this->middleware('can:admin.computers.show')->only('show');
		$this->middleware('can:admin.computers.edit')->only('edit', 'update');
		$this->middleware('can:admin.computers.destroy')->only('destroy');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$computers = Computer::orderBy('created_at', 'desc')->paginate('5');

		return view('admin.computers.index', compact('computers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.computers.create', ['computer' => new Computer()]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ComputerRequest $request)
	{
		Computer::create($request->validated());

		return redirect(route('admin.computers.index'))->with('info', 'Se guardo con éxito!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Computer  $computer
	 * @return \Illuminate\Http\Response
	 */
	public function show(Computer $computer)
	{
		return view('admin.computers.show', compact('computer'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Computer  $computer
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Computer $computer)
	{
		return view('admin.computers.edit', compact('computer'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Computer  $computer
	 * @return \Illuminate\Http\Response
	 */
	public function update(ComputerRequest $request, Computer $computer)
	{
		$computer->update($request->validated());

		return redirect(route('admin.computers.index'))->with('success', 'Se actualizo con éxito!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Computer  $computer
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Computer $computer)
	{
		$computer->delete();

		return back()->with('success', 'Se elimino con éxito!');
	}
}
