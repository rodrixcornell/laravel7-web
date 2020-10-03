<div class="col-md-{{ $col }}">
	<div class="card">
		<div class="card-header">
			<i class="fas fa-tachometer-alt"></i>&nbsp;{{ $cardHeader }}
		</div>
		<div class="card-body">
			{{$slot}}
		</div>
	</div>
</div>
