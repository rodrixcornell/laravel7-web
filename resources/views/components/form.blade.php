@php
$method = mb_strtolower($method);
$field = '';
if ($method == 'put') {
$method = 'POST';
$field = 'PUT';
} elseif ($method == 'delete') {
$method = 'POST';
$field = 'DELETE';
} else {
$method = 'POST';
}
@endphp

<form action="{{ $action }}" method="{{ mb_strtoupper($method) }}">
	@csrf
	@method($field)
	{{ $slot }}
</form>
