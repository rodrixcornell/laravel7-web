<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserController extends Controller
{
	/**
	 * The user repository instance.
	 * @var object
	 */
	protected $users;

	/**
	 * Undocumented variable
	 *
	 * @var string
	 */
	protected $route = 'users';

	/**
	 * Create a new controller instance.
	 *
	 * @param  UserRepository  $users
	 * @return void
	 */
	public function __construct(UserRepository $users)
	{
		$this->users = $users;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		try {
			$columns = [
				'id' => '#',
				'name' => trans('locales.name'),
				'email' => trans('locales.emailAddress'),
				'created_at' => trans('locales.created_at'),
				'updated_at' => trans('locales.updated_at'),
				'' => '',
			];
			// $this->authorize('add_organization');
			$data = $this->users->index($request);
			$search = ($data->total() > 0) ? $request->search : '';
			if ($request->is('api/*')) {
				return response()->json($data, 200);
			}
			// return response()->view('admin.users.index', $data);
			return view('admin.' . $this->route . '.index', compact('columns', 'data', 'search'))->with([
				'route' => $this->route
			]);
		} catch (\Exception $e) {
			$data = [
				"message" => "Error, try again!",
				"text" =>    $e->getMessage()
			];
			return response()->json($data, 401);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.' . $this->route . '.create')->with([
			'route' => $this->route
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}