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
					<li class="breadcrumb-item active" aria-current="page">{{ __('locales.users') }}</li>
				</ol>
			</nav>

			<div class="row">
				<div class="col-md-9">
					<form role="form" class="form-inline text-center" method="GET"
						action="{{ route('admin.'.$route.'.index') }}">
						{{-- @csrf --}}

						<div class="form-group">
							{{-- <label class="my-1 mr-2" for="inputSearch">{{ __('locales.name') }} /
							{{ __('locales.emailAddress') }}</label> --}}
							<input type="search" class="form-control mr-sm-2" id="inputSearch" name="search"
								value="{{ $search ?? '' }}"
								placeholder="{{ __('locales.name') }} / {{ __('locales.emailAddress') }}"
								aria-label="Search" />
						</div>

						<button type="submit" class="btn btn-primary my-2 mr-sm-2">{{ __('locales.search') }}</button>
						<a href="{{ route('admin.'.$route.'.index') }}" type="button"
							class="btn btn-secondary my-2 mr-sm-2">{{ __('locales.clear') }}</a>
					</form>
				</div>
				<div class="col-md-3 text-right">
					<a href="{{ route('admin.'.$route.'.create') }}" type="button"
						class="btn btn-success my-2 mr-sm-2">{{ __('locales.create') }}</a>
				</div>
			</div>

			<table class="table">
				<thead>
					<tr>
						@forelse($columns as $key => $value)
						<th scope="col">{{ $value }}</th>
						{{-- <th scope="col">{{ __('locales.name') }}</th>
						<th scope="col">{{ __('locales.emailAddress') }}</th>
						<th scope="col"></th> --}}
						@empty
						<th scope="col" colspan="4"></th>
						@endforelse
					</tr>
				</thead>
				<tbody>
					@forelse ($data as $value)
					<tr>
						{{-- @foreach ($columns as $key2 => $value2)
						@if ($key2 == 'id')
						<th scope="row">
							<a href="{{ route('admin.'.$route.'.show',$value->{$key2}) }}">
						{{ $value->{$key2} }}
						</a>
						</th>
						@else
						<td>{{ $value->{$key2} }}</td>
						@endif
						@endforeach --}}
						<th scope="row">
							<a href="{{ route('admin.'.$route.'.show',$value->id) }}">{{ $value->id }}</a>
						</th>
						<td>{{ $value->name }}</td>
						<td>{{ $value->email }}</td>
						<td>{{ $value->created_at }}</td>
						<td>{{ $value->updated_at }}</td>
						<td>
							<div class="text-right">
								<a href="{{ route('admin.'.$route.'.show',$value->id) }}" type="button"
									class="btn btn-info my-2 mr-sm-2">
									<i class="fas fa-eye"></i>&nbsp;{{ __('locales.show') }}</a>
								<a href="{{ route('admin.'.$route.'.edit',$value->id) }}" type="button"
									class="btn btn-warning my-2 mr-sm-2">
									<i class="fa fa-edit"></i>&nbsp;{{ __('locales.edit') }}</a>
								<a href="{{ route('admin.'.$route.'.destroy',$value->id) }}" type="button"
									class="btn btn-danger my-2 mr-sm-2">
									<i class="fa fa-trash"></i>&nbsp;{{ __('locales.delete') }}</a>
							</div>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="4">{{ __('locales.search_returned') }}</th>
					</tr>
					@endforelse
				</tbody>
			</table>

			{{-- Pagination --}}
			@isset($data)
			<div class="d-flex justify-content-center">
				{{-- {!! $data->appends(Request::all())->links() !!} --}}
				{{-- {!! $data->links() !!} --}}

				{!! $data->onEachSide(2)->links() !!}

				{{-- <nav>
							<ul class="pagination">
								<li class="page-item:first-child">
									<a class="page-link" href="{{ $data->toArray()['first_page_url'] }}"><<</a> </li> {!! $data->links() !!}
					<li class="page-item:last-child">
						<a class="page-link" href="{{ $data->toArray()['last_page_url'] }}">>></a>
					</li>
					</ul>
					</nav> --}}
			</div>
			@endisset
		</div>
	</div>
</div>
@endsection
