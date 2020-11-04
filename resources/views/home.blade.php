@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<i class="fas fa-tachometer-alt"></i>&nbsp;{{ __('locales.dashboard') }}
		</div>
		<div class="card-body">
			@if(session('msg'))
			<x-alert>
				<x-slot name="msg">{{ session('msg') }}</x-slot>
				<x-slot name="status">{{ session('status') }}</x-slot>
			</x-alert>
			@endif

			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					@each('partials.breadcrumb', $breadcrumb, 'breadcrumb', 'partials.empty')
				</ol>
			</nav>

			<!-- Portfolio Grid -->
			<div id="portfolio">
				<div class="row">

					<div class="col-sm-2">
						<div class="card" style="cursor: pointer"
							onclick="window.location='{{ route('admin.users.index') }}'">
							<div class="card-header">{{ __('locales.users') }}</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item">{{ __('locales.create') }} / {{ __('locales.edit') }}</li>
							</ul>
						</div>
					</div>

					<div class="col-sm-2">
						<div class="card" style="cursor: pointer"
							onclick="window.location='{{ route('admin.roles.index') }}'">
							<div class="card-header">{{ __('locales.roles') }}</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item">{{ __('locales.create') }} / {{ __('locales.edit') }}</li>
							</ul>
						</div>
					</div>

					<div class="col-sm-2">
						<div class="card" style="cursor: pointer"
							onclick="window.location='{{ route('admin.permissions.index') }}'">
							<div class="card-header">{{ __('locales.permissions') }}</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item">{{ __('locales.create') }} / {{ __('locales.edit') }}</li>
							</ul>
						</div>
					</div>

				</div>
			</div>

			<br>
			{{ __('locales.logged') }}
		</div>
	</div>
</div>
@endsection
