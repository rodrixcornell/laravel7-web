<div class="d-flex justify-content-center">
	{{-- {!! $data->appends(Request::all())->links() !!} --}}
	{{-- {!! $data->links() !!} --}}
	{{ $data }}
	{{-- {{ $data->links() }} --}}

	{{-- {{ $data->onEachSide($eachSide)->links() }} --}}

	{{-- <nav>
			<ul class="pagination">
				<li class="page-item:first-child">
					<a class="page-link" href="{{ $data->toArray()['first_page_url'] }}">
	<<</a> </li> {!! $data->links() !!}
		<li class="page-item:last-child">
			<a class="page-link" href="{{ $data->toArray()['last_page_url'] }}">>></a>
		</li>
		</ul>
		</nav> --}}
</div>
