@extends('layouts.app')

@section('content')
<x-page>
	<x-slot name="col">12</x-slot>
	<x-slot name="cardHeader">{{ __('locales.dashboard') }}</x-slot>

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

	<x-search>
		<x-slot name="route">{{ $route }}</x-slot>
		<x-slot name="search">{{ $search }}</x-slot>
	</x-search>

	<table class="table">
		<thead>
			<tr>
				@foreach($columns as $key => $value)
				<th scope="col" class="text-center">
					<a href="{{ route($route.'.index','sort='.$order.$key) }}">{{ __($value) }}</a>
				</th>
				@endforeach
				<th scope="col" class="text-right">{{ __('locales.actions') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($data as $value)
			<tr>
				@foreach (array_flip($columns) as $key)
				@if ($key == 'id')
				<th scope="row">
					<a href="{{ route($route.'.show',$value->{$key}) }}">
						{{ $value->{$key} }}
					</a>
				</th>
				@else
				<td>{{ $value->{$key} }}</td>
				@endif
				@endforeach
				<td class="text-right">
					<a href="{{ route($route.'.show',$value->id) }}" type="button" class="btn btn-info my-1 mr-sm-1">
						<i class="fas fa-eye"></i>&nbsp;{{-- __('locales.show') --}}</a>
					<a href="{{ route($route.'.edit',$value->id) }}" type="button" class="btn btn-warning my-1 mr-sm-1">
						<i class="fa fa-edit"></i>&nbsp;{{-- __('locales.edit') --}}</a>
					<a href="{{ route($route.'.show',[$value->id,'delete='.$value->id]) }}" type="button"
						class="btn btn-danger my-1 mr-sm-1">
						<i class="fa fa-trash"></i>&nbsp;{{-- __('locales.delete') --}}</a>
				</td>
			</tr>
			@empty
			<tr>
				<td colspan="{{ count($columns)+1 }}">{{ __('locales.search_returned') }}</th>
			</tr>
			@endforelse
		</tbody>
	</table>

	{{-- Pagination --}}
	@isset($data)
	<x-pagination>
		<x-slot name="data">{!! $data->onEachSide(2)->links() !!}</x-slot>
		{{-- <x-slot name="eachSide">{{ 2 }}</x-slot> --}}
	</x-pagination>
	@endisset
</x-page>
@endsection
