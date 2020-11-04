<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
	/**
	 * Undocumented variable
	 *
	 * @var object
	 */
	protected $model;
	/**
	 * Undocumented variable
	 *
	 * @var object
	 */
	private $search;

	/**
	 * Undocumented variable
	 *
	 * @var integer
	 */
	protected $perPage = 7;

	/**
	 * Undocumented variable
	 *
	 * @var array
	 */
	protected $filters = [
		'name', 'description',
	];

	/**
	 * Undocumented function
	 *
	 * @param SearchRepository $search
	 */
	function __construct(SearchRepository $search)
	{
		$this->model = Role::class;
		$this->search = $search;
	}

	/**
	 * Undocumented function
	 *
	 * @param object $request
	 * @return void
	 */
	public function index(object $request)
	{
		return $this->search->searchBuilder($this->model::with([]), $request, $this->perPage, $this->filters);
	}

	/**
	 * Undocumented function
	 *
	 * @param integer $id
	 * @return void
	 */
	public function show(int $id)
	{
		$registered = $this->model::findOrFail($id);
		$registered = $this->model::find($id);
		if (!$registered) {
			$registered = "$id";
			session()->flash('status', 'error');
			session()->flash('msg', $registered);
			return redirect()->back();
		}

		return $registered;
	}

	/**
	 * Undocumented function
	 *
	 * @param object $request
	 * @return void
	 */
	public function store(object $request)
	{
		$validator = \Validator::make($request->all(), [
			'name' => ['required', 'string', 'max:255'],
			'description' => ['required', 'string', 'max:355'],
		]);

		if (!$request->is('api/*')) {
			if (!$validator->validate()) {
				session()->flash('status', 'error');
				session()->flash('msg', $validator->validate());
				return redirect()->back();
			}
		} else {
			if ($validator->fails()) {
				throw new \Exception("invalid_fields", 400);
			}
		}

		$data = [
			"name" => $request->name,
			"slug" => $request->slug,
			"description" => $request->description,
		];

		$registered = $this->model::create($data);
		if (!$registered) {
			session()->flash('status', 'error');
			session()->flash('msg', $registered);
		} else {
			session()->flash('status', 'success');
			session()->flash('msg', trans('locales.record_created'));
		}
		return $registered;
	}

	/**
	 * Undocumented function
	 *
	 * @param object $request
	 * @param integer $id
	 * @return void
	 */
	public function update(object $request, int $id)
	{
		$validator = \Validator::make($request->all(), [
			'name' => ['required', 'string', 'max:255'],
			'description' => ['required', 'string', 'max:355'],
		]);;

		if (!$request->is('api/*')) {
			if (!$validator->validate()) {
				session()->flash('status', 'error');
				session()->flash('msg', $validator->validate());
				return redirect()->back();
			}
		} else {
			if ($validator->fails()) {
				throw new \Exception("invalid_fields", 400);
			}
		}

		$data = [
			"name" => $request->name,
			"slug" => $request->slug,
			"description" => $request->description,
		];

		$registered = $this->model::where(["id" => $id])->update($data);
		if (!$registered) {
			session()->flash('status', 'error');
			session()->flash('msg', $registered);
		} else {
			session()->flash('status', 'success');
			session()->flash('msg', trans('locales.record_updated'));
		}

		return $registered;
	}

	/**
	 * Undocumented function
	 *
	 * @param integer $id
	 * @return void
	 */
	public function destroy(int $id)
	{
		$registered = $this->model::where(["id" => $id])->delete();
		if (!$registered) {
			session()->flash('status', 'error');
			session()->flash('msg', $registered);
		} else {
			session()->flash('status', 'success');
			session()->flash('msg', trans('locales.record_deleted'));
		}

		return $registered;
	}
}
