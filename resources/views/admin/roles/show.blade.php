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

	<p><strong>{{ __('locales.name') }}:</strong>&nbsp;{{$data->name}}</p>
	<p><strong>{{ __('locales.slug') }}:</strong>&nbsp;{{$data->slug}}</p>
	<p><strong>{{ __('locales.description') }}:</strong>&nbsp;{{$data->description}}</p>

	<a href="{{ route($route.'.index') }}" type="button"
		class="btn btn-secondary my-2 mr-sm-2 float-right">{{ __('locales.cancel') }}</a>
	@if ($delete)
	<x-form>
		<x-slot name="action">{{ route($route.'.destroy', $data->id) }}</x-slot>
		<x-slot name="method">{{ 'DELETE' }}</x-slot>

		<button type="submit" class="btn btn-danger my-2 mr-sm-2 float-right">{{ __('locales.delete') }}</button>
	</x-form>
	@else
	<a href="{{ route($route.'.edit',$data->id) }}" type="button"
		class="btn btn-warning my-2 mr-sm-2 float-right">{{ __('locales.edit') }}</a>
	@endif
</x-page>
@endsection
