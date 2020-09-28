<?php

namespace App\Repositories;

class SearchRepository
{
	/**
	 * Undocumented function
	 *
	 * @param object $queryBuilder
	 * @param object $request
	 * @param integer $perPage
	 * @param array $filters
	 * @return void
	 */

	public function searchBuilder(object $queryBuilder, $request, int $perPage = 15, array $filters = [])
	{
		foreach ($request->query() as $key => $value) {
			// echo "$key => $value";
			if ($key === 'search') {
				foreach ($filters as $key => $column) {
					// echo "$key => $column";
					$queryBuilder->orWhere($column, "like", "%$value%");
				}
			} elseif ($key !== 'page' && $key !== 'sort') {
				// $queryBuilder->where($key, "=", $value);
				$queryBuilder->where($key, $value);
			}
		}

		if ($request->sort) {
			$collection = \Str::of($request->sort)->explode(':');
			$column = ($collection[0]) ? $collection[0] : "id";
			$sort = ($collection[1] == "asc") ? "asc" : "desc";
			$queryBuilder->sortBy($column, $sort);
			// $sort = ($request->sort == "asc") ? "asc" : "desc";
			// $queryBuilder->sortBy("name", $sort);
		}

		// dd($queryBuilder, $queryBuilder->toSql(), $queryBuilder->getBindings());

		// return $queryBuilder->simplePaginate(($request->count) ? $request->count : $perPage);
		return $queryBuilder->paginate(($request->count) ? $request->count : $perPage);
	}
}