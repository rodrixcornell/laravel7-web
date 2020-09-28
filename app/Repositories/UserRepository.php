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
	function __construct(User $model, SearchRepository $search)
	{
		$this->model = $model;
		$this->search = $search;
	}

	/**
	 * Undocumented function
	 *
	 * @param object $request
	 * @return void
	 */
	public function index($request)
	{
		// dd($this->model->getFillable());
		return $this->search->searchBuilder($this->model::with([]), $request, $this->perPage, $this->filters);
		// return $this->search->searchBuilder(User::with([]), $request);
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
		// $user = User::where(["id"=>$id])->first();
		// $user = User::findOrFail($id);
		$user = $this->model::findOrFail($id);
		$user->person;
		$user->groups;
		$user->roles;
		$user->roles[0]->permissions;
		// $role = Role::findOrFail($user->roles[0]->id);
		// $user->permission = $role->permissions;

		return $user;
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
			"access_token" => "nullable",
			"admin" => "nullable",
			"api_token" => "nullable",
			"email" => "required",
			"email_verified_at" => "nullable",
			"last_login_on" => "nullable",
			"login" => "required",
			"must_change_passwd" => "required",
			"passwd_changed_on" => "nullable",
			"password" => "required",
			"remember_token" => "nullable",
			"status" => "nullable",
		]);
		if ($validator->fails()) {
			throw new \Exception("invalid_fields", 400);
		} else {
			$data = [
				"access_token" => $request->access_token,
				"admin" => $request->admin,
				"api_token" => $request->api_token,
				"email" => $request->email,
				"email_verified_at" => $request->email_verified_at,
				"last_login_on" => $request->last_login_on,
				"login" => $request->login,
				"must_change_passwd" => $request->must_change_passwd,
				"passwd_changed_on" => $request->passwd_changed_on,
				"password" => $request->password,
				"remember_token" => $request->remember_token,
				"status" => $request->status,
			];
			// return User::create($data);
			return $this->model::create($data);
		}
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
			"access_token" => "nullable",
			"admin" => "nullable",
			"api_token" => "nullable",
			"email" => "required|email|unique:users,email,$id",
			"email_verified_at" => "nullable",
			"last_login_on" => "nullable",
			"login" => "required",
			"must_change_passwd" => "required",
			"passwd_changed_on" => "nullable",
			"password" => "required",
			"remember_token" => "nullable",
			"status" => "nullable",
		]);
		if ($validator->fails()) {
			throw new \Exception("invalid_fields", 400);
		} else {
			$data = [
				"access_token" => $request->access_token,
				"admin" => $request->admin,
				"api_token" => $request->api_token,
				"email" => $request->email,
				"email_verified_at" => $request->email_verified_at,
				"last_login_on" => $request->last_login_on,
				"login" => $request->login,
				"must_change_passwd" => $request->must_change_passwd,
				"passwd_changed_on" => $request->passwd_changed_on,
				"password" => $request->password,
				"remember_token" => $request->remember_token,
				"status" => $request->status,
			];
			// return User::where(["id" => $id])->update($data);
			return $this->model::where(["id" => $id])->update($data);
		}
	}

	/**
	 * Undocumented function
	 *
	 * @param integer $id
	 * @return void
	 */
	public function destroy(int $id)
	{
		// return User::where(["id" => $id])->delete();
		return $this->model::where(["id" => $id])->delete();
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