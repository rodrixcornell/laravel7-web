<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Locale
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$locale = (!session('locale')) ? App::getLocale() : session('locale');
		session(['locale' => $locale]);
		App::setLocale($locale);

		return $next($request);
	}
}