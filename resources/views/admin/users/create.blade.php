@extends('layouts.app')

@section('content')
	<div class="card">
		<div class="card-header">{{ __('Dashboard') }}</div>

		<div class="card-body">
			@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
			@endif

			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ __('Users') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('Create') }}</li>
				</ol>
			</nav>
		</div>
	</div>
@endsection
