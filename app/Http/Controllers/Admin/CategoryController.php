<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Category::all();

			return Datatables()->of($data)
				->addColumn('action', function ($category) {
					$actionBtn = '
                        <div class="btn-group">
                            <a href="' . route('admin.products.show', $category->id) . '" class="btn btn-info">Ver</a>
                            <a href="' . route('admin.products.edit', $category->id) . '" class="btn btn-warning">Modificar</a>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="' . $category->id . '">Eliminar</button>
                        </div>
                    ';

					return $actionBtn;
				})
				->rawColumns(['action'])
				->only(['id', 'name', 'slug', 'action'])
				->make(true);
		} else {
			$categories = Category::orderBy('id', 'desc')->paginate('10');

			return view('admin.categories.index', compact('categories'));
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
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
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
	}
}
