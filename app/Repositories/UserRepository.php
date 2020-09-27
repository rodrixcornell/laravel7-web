<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\UserSearchRepository;
// use Illuminate\Support\Facades\Validator;

class UserRepository extends Repository
{
	private $userSearch;

	protected $model;

	protected $perPage = 7;

	function __construct(UserSearchRepository $userSearch, User $modelUser)
	{
		$this->userSearch = $userSearch;
		$this->model = $modelUser;
	}

	public function index($request)
	{
		return $this->userSearch->search($this->model::with([]), $request, $this->perPage);
		// return $this->userSearch->search(User::with([]), $request);
	}

	public function show($id)
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

	public function store($request)
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

	public function update($request, $id)
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

	public function destroy($id)
	{
		// return User::where(["id" => $id])->delete();
		return $this->model::where(["id" => $id])->delete();
	}
}