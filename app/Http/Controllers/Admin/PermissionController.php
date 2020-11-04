<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PermissionRepository;


class PermissionController extends Controller
{
	/**
	 * The user repository instance.
	 * @var object
	 */
	protected $repository;

	/**
	 * Undocumented variable
	 *
	 * @var string
	 */
	protected $route = 'admin.permissions';

	/**
	 * Undocumented variable
	 *
	 * @var array
	 */
	protected $columns = [
		'id' => '#',
		'name' => 'locales.name',
		'slug' => 'locales.slug',
		'description' => 'locales.description',
		'active' => 'locales.active',
		'created_at' => 'locales.created_at',
		'updated_at' => 'locales.updated_at',
	];

	/**
	 * Create a new controller instance.
	 *
	 * @param  UserRepository  $repository
	 * @return void
	 */
	public function __construct(PermissionRepository $permissionRepository)
	{
		$this->repository = $permissionRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$breadcrumb = [
			(object) ['url' => route('home'), 'title' => trans('locales.home')],
			(object) ['url' => '', 'title' => trans('locales.permissions')],
		];

		if (!$request->is('api/*')) {
			$data = $this->repository->index($request);
			$search = ($data->total() > 0) ? $request->search : '';
			$order = ($request->sort) ? ':desc' : ':asc';
			$order = (!\Str::startsWith($request->sort, '-')) ? '-' : '';

			return view($this->route . '.index', compact('breadcrumb', 'data', 'search', 'order'))->with([
				'route' => $this->route,
				'columns' => $this->columns,
			]);
		} else {
			try {
				$data = $this->repository->index($request);
				return response()->json($data, 200);
			} catch (\Exception $e) {
				$request->session()->flash('status', 'error');
				$request->session()->flash('msg', 'Error, try again! ' . $e->getMessage() . ', code ' . $e->getCode());
				$data = [
					"message" => "Error, try again!",
					"code" => $e->getCode(),
					"text" => $e->getMessage()
				];
				return response()->json($data, 401);
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, int $id)
	{
		$breadcrumb = [
			(object) ['url' => route('home'), 'title' => trans('locales.home')],
			(object) ['url' => route($this->route . '.index'), 'title' => trans('locales.permissions')],
			(object) ['url' => '', 'title' => (!$request->delete) ? trans('locales.show') : trans('locales.delete')],
		];

		if (!$request->is('api/*')) {
			$data = $this->repository->show($id);

			$delete = ($request->delete ?? false);
			return view($this->route . '.show', compact('breadcrumb', 'data', 'delete'))->with([
				'route' => $this->route,
			]);
		} else {
			try {
				$data = $this->repository->show($id);
				return response()->json($data, 200);
			} catch (\Exception $e) {
				$request->session()->flash('status', 'error');
				$request->session()->flash('msg', 'Error, try again! ' . $e->getMessage() . ', code ' . $e->getCode());

				$data = [
					"message" => "Error, try again!",
					"code" => $e->getCode(),
					"text" => $e->getMessage()
				];
				return response()->json($data, 400);
			}
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$breadcrumb = [
			(object) ['url' => route('home'), 'title' => trans('locales.home')],
			(object) ['url' => route($this->route . '.index'), 'title' => trans('locales.permissions')],
			(object) ['url' => '', 'title' => trans('locales.create')],
		];

		return view($this->route . '.create', compact('breadcrumb'))->with([
			'route' => $this->route,
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
		if (!$request->is('api/*')) {
			$data = $this->repository->store($request);

			return redirect()->route($this->route . '.show', $data);
		} else {
			try {
				$data = $this->repository->store($request);
				return response()->json($data, 201);
			} catch (\Exception $e) {
				$request->session()->flash('status', 'error');
				$request->session()->flash('msg', 'Error, try again! ' . $e->getMessage() . ', code ' . $e->getCode());

				$data = [
					"message" => "Error, try again!",
					"code" => $e->getCode(),
					"text" => $e->getMessage()
				];
				return response()->json($data, 400);
			}
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request, int $id)
	{
		$breadcrumb = [
			(object) ['url' => route('home'), 'title' => trans('locales.home')],
			(object) ['url' => route($this->route . '.index'), 'title' => trans('locales.permissions')],
			(object) ['url' => '', 'title' => trans('locales.edit')],
		];

		$data = $this->repository->show($id);

		return view($this->route . '.edit', compact('breadcrumb', 'data'))->with([
			'route' => $this->route,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, int $id)
	{
		if (!$request->is('api/*')) {
			$data = $this->repository->update($request, $id);

			return redirect()->route($this->route . '.show', $id);
		} else {
			try {
				$data = $this->repository->update($request, $id);
				return response()->json($data, 200);
			} catch (\Exception $e) {
				$request->session()->flash('status', 'error');
				$request->session()->flash('msg', 'Error, try again! ' . $e->getMessage() . ', code ' . $e->getCode());

				$data = [
					"message" => "Error, try again!",
					"code" => $e->getCode(),
					"text" => $e->getMessage()
				];
				return response()->json($data, 400);
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, int $id)
	{
		if (!$request->is('api/*')) {
			$data = $this->repository->destroy($id);

			return redirect()->route($this->route . '.index');
		} else {
			try {
				$data = $this->repository->destroy($id);
				return response()->json($data, 204);
			} catch (\Exception $e) {
				$request->session()->flash('status', 'error');
				$request->session()->flash('msg', 'Error, try again! ' . $e->getMessage() . ', code ' . $e->getCode());

				$data = [
					"message" => "Error, try again!",
					"code" => $e->getCode(),
					"text" => $e->getMessage()
				];
				return response()->json($data, 400);
			}
		}
	}
}
