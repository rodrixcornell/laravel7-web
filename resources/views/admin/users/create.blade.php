@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<i class="fas fa-tachometer-alt"></i>&nbsp;{{ __('locales.dashboard') }}
		</div>
		<div class="card-body">
			@if (session('status'))
			<div class="alert alert-success" role="alert">
				{{ session('status') }}
			</div>
			@endif

			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('locales.home') }}</a></li>
					<li class="breadcrumb-item"><a
							href="{{ route('admin.'.$route.'.index') }}">{{ __('locales.users') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('locales.create') }}</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
@endsection
