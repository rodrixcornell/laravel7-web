<div class="row">
	<div class="col-md-9">
		<form role="form" class="form-inline text-center" method="GET" action="{{ route($route.'.index') }}">
			@csrf

			<div class="form-group">
				{{-- <label class="my-1 mr-2" for="inputSearch">{{ __('locales.name') }} /
				{{ __('locales.emailAddress') }}</label> --}}
				<input type="search" class="form-control mr-sm-2" id="inputSearch" name="search" value="{{ $search }}"
					placeholder="{{ __('locales.search') }}" aria-label="Search" />
			</div>

			<button type="submit" class="btn btn-primary my-2 mr-sm-2">
				<i class="fas fa-search"></i>&nbsp;{{ __('locales.search') }}</button>
			<a href="{{ route($route.'.index') }}" type="button" class="btn btn-secondary my-2 mr-sm-2">
				<i class="fas fa-chalkboard"></i>&nbsp;{{ __('locales.clear') }}</a>
		</form>
	</div>
	<div class="col-md-3 text-right">
		<a href="{{ route($route.'.create') }}" type="button" class="btn btn-success my-2 mr-sm-2">
			<i class="fas fa-plus-circle"></i>&nbsp;{{ __('locales.create') }}</a>
	</div>
</div>
