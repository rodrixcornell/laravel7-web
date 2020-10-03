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
		<label for="email">{{ __('locales.emailAddress') }}</label>
		<input type="mail" class="form-control @error('email') is-invalid @enderror" name=" email"
			value="{{ old('email') ?? ($data->email ?? '') }}" autocomplete="email">

		@error('email')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>

	<div class="form-group col-6">
		<label for="password">{{ __('locales.password') }}</label>
		<input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
			autocomplete="new-password">

		@error('password')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>

	<div class="form-group col-6">
		<label for="password_confirmation">{{ __('locales.passwordConfirmation') }}</label>
		<input type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
	</div>

	<div class="form-group col-6">
		<label for="roles">{{ __('locales.role_list') }}</label>
		<select class="form-control" multiple name="roles[]">
		</select>
	</div>
</div>
