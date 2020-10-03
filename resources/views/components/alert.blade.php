@if ($msg)
<div class="alert alert-{{ ($status == "error") ? "danger" : $status }}" role="alert">
	{!! $msg !!}
</div>
@endif
