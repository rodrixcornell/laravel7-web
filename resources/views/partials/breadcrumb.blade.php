@if ($breadcrumb->url)
<li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ __($breadcrumb->title) }}</a></li>
@else
<li class="breadcrumb-item active" aria-current="page">{{ __($breadcrumb->title) }}</li>
@endif
