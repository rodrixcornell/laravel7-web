<?php

namespace App\Repositories;

use App\Models\User;
// use App\Repositories\SearchRepository;

class UserRepository
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
		'name', 'email',
	];

	/**
	 * Undocumented function
	 *
	 * @param User $model
	 * @param SearchRepository $search
	 */
	// function __construct(User $model, SearchRepository $search)
	function __construct(SearchRepository $search)
	{
		$this->model = User::class;
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
		// dd($this->model->getFillable());
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
		// if (!is_numeric($id)) abort(400, "ID \"$id\" invalido.");
		// $registered = $this->model::where(["id"=>$id])->first();
		$registered = $this->model::findOrFail($id);
		$registered = $this->model::find($id);
		if (!$registered) {
			$registered = "$id";
			session()->flash('status', 'error');
			session()->flash('msg', $registered);
			return redirect()->back();
		}
		// $registered->person;
		// $registered->groups;
		// $registered->roles;
		// $registered->roles[0]->permissions;
		// $role = Role::findOrFail($registered->roles[0]->id);
		// $registered->permission = $role->permissions;

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
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
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
			"email" => $request->email,
			'password' => \Hash::make($request->password),
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
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
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
			"email" => $request->email,
			'password' => \Hash::make($request->password),
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

	public function isAdmin()
	{
		return $this->is_admin;
	}

	public function isActive()
	{
		return $this->is_active;
	}
}
