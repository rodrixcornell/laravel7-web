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
					<li class="breadcrumb-item active" aria-current="page">{{ __('Users') }}</li>
				</ol>
			</nav>

			<div class="row">
				<div class="col-md-6">
					<form role="form" class="form-inline text-center" method="GET" action="{{ route('admin.users.index') }}">
						{{-- @csrf --}}

						<div class="form-group">
							<label class="my-1 mr-2" for="inputSearch">{{ __('Name') }} / {{ __('Email') }}</label>
							<input type="search" class="form-control mr-sm-2" id="inputSearch" name="search" value="{{ $search ?? '' }}" placeholder="Search" aria-label="Search" />
						</div>

						<button type="submit" class="btn btn-primary my-2 mr-sm-2">{{ __('Search') }}</button>
						<a href="{{ route('admin.users.index') }}" type="button" class="btn btn-secondary my-2 mr-sm-2">{{ __('Clear') }}</a>
					</form>
				</div>
				<div class="col-md-6 text-right">
					<a href="{{ route('admin.users.create') }}" type="button" class="btn btn-success my-2 mr-sm-2">{{ __('Create') }}</a>
				</div>
			</div>

			<table class="table">
				<thead>
					<tr>
					<th scope="col">#</th>
					<th scope="col">{{ __('Name') }}</th>
					<th scope="col">{{ __('Email') }}</th>
					<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($data as $value)
						<tr>
							<th scope="row">{{ $value->id }}</th>
							<td>{{ $value->name }}</td>
							<td>{{ $value->email }}</td>
							<td>Show, Edit, Delete</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			{{-- Pagination --}}
			<div class="d-flex justify-content-center">
				{{-- {!! $data->appends(Request::all())->links() !!} --}}
				{{-- {!! $data->links() !!} --}}
				{{ $data }}

				{{-- <nav>
					<ul class="pagination">
						<li class="page-item:first-child">
							<a class="page-link" href="{{ $data->toArray()['first_page_url'] }}"><<</a>
						</li>
						{!! $data->links() !!}
						<li class="page-item:last-child">
							<a class="page-link" href="{{ $data->toArray()['last_page_url'] }}">>></a>
						</li>
					</ul>
				</nav> --}}
			</div>
		</div>
	</div>
@endsection
