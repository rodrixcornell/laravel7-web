<div class="row">
	<div class="form-group col-6">
		<label for="name">{{ __('locales.name') }}</label>
		<input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
			value="{{ old('name') ?? ($data->name ?? '') }}" autocomplete="name" autofocus>

		@error('name')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>

	<div class="form-group col-6">
		<label for="description">{{ __('locales.description') }}</label>
		<input type="text" class="form-control @error('description') is-invalid @enderror" name=" description"
			value="{{ old('description') ?? ($data->description ?? '') }}" autocomplete="description">

		@error('description')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>

	<div class="form-group col-6">
		<label for="roles">{{ __('locales.role_list') }}</label>
		<select class="form-control" multiple name="roles[]">
		</select>
	</div>
</div>
