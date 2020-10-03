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

	<x-form>
		<x-slot name="action">{{ route($route.'.update', $data->id) }}</x-slot>
		<x-slot name="method">{{ 'put' }}</x-slot>

		@include($route.'.form')

		<button type="submit" class="btn btn-primary my-2 mr-sm-2 float-right">{{ __('locales.save') }}</button>
		<a href="{{ route($route.'.index') }}" type="button"
			class="btn btn-secondary my-2 mr-sm-2 float-right">{{ __('locales.cancel') }}</a>
	</x-form>

</x-page>
@endsection
