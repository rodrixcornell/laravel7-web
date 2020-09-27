<?php

namespace App\Repositories;

use Illuminate\Support\Str;

class UserSearchRepository
{
	/**
	 * Undocumented function
	 *
	 * @param [type] $queryBuilder
	 * @param [type] $request
	 * @return void
	 */
	public function search($queryBuilder, $request, int $perPage = 15)
	{

		foreach ($request->query() as $key => $value) {
			if ($key === 'search') {
				// $queryBuilder->where("name", "like", Str::lower("%$value%"));
				$queryBuilder->orWhere("name", "like", "%$value%");
				$queryBuilder->orWhere("email", "like", "%$value%");
			} elseif ($key !== 'page' && $key !== 'order') {
				// echo "$key => $value";
				// $queryBuilder->where($key, "=", $value);
				$queryBuilder->where($key, $value);
			}
		}
		// dd($queryBuilder, $queryBuilder->toSql(), $queryBuilder->getBindings());

		// if ($request->access_token) {
		// 	$queryBuilder->where("access_token", "=", $request->access_token);
		// }

		// if ($request->admin) {
		// 	$queryBuilder->where("admin", "=", $request->admin);
		// }

		// if ($request->api_token) {
		// 	$queryBuilder->where("api_token", "=", $request->api_token);
		// }

		// if ($request->email) {
		// 	$queryBuilder->where("email", "=", $request->email);
		// }

		// if ($request->email_verified_at) {
		// 	$queryBuilder->where("email_verified_at", "=", $request->email_verified_at);
		// }

		// if ($request->id) {
		// 	$queryBuilder->where("id", "=", $request->id);
		// }

		// if ($request->last_login_on) {
		// 	$queryBuilder->where("last_login_on", "=", $request->last_login_on);
		// }

		// if ($request->login) {
		// 	$queryBuilder->where("login", "=", $request->login);
		// }

		// if ($request->must_change_passwd) {
		// 	$queryBuilder->where("must_change_passwd", "=", $request->must_change_passwd);
		// }

		// if ($request->passwd_changed_on) {
		// 	$queryBuilder->where("passwd_changed_on", "=", $request->passwd_changed_on);
		// }

		// if ($request->password) {
		// 	$queryBuilder->where("password", "=", $request->password);
		// }

		// if ($request->remember_token) {
		// 	$queryBuilder->where("remember_token", "=", $request->remember_token);
		// }

		// if ($request->status) {
		// 	$queryBuilder->where("status", "=", $request->status);
		// }

		if ($request->order) {
			$collection = \Str::of($request->order)->explode(':');
			$column = ($collection[0]) ? $collection[0] : "id";
			$order = ($collection[1] == "asc") ? "asc" : "desc";
			$queryBuilder->orderBy($column, $order);
			// $order = ($request->order == "asc") ? "asc" : "desc";
			// $queryBuilder->orderBy("name", $order);
		}

		// return $queryBuilder->simplePaginate(($request->count) ? $request->count : $perPage);
		return $queryBuilder->paginate(($request->count) ? $request->count : $perPage);
	}
}