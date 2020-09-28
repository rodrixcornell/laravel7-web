@extends('layouts.app')

@section('content')
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">{{ __('locales.passwordConfirmation') }}</div>

			<div class="card-body">
				{{ __('locales.passwordConfirm') }}

				<form method="POST" action="{{ route('password.confirm') }}">
					@csrf

					<div class="form-group row">
						<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('locales.password') }}</label>

						<div class="col-md-6">
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-8 offset-md-4">
							<button type="submit" class="btn btn-primary">
								{{ __('locales.passwordConfirmation') }}
							</button>

							@if (Route::has('password.request'))
								<a class="btn btn-link" href="{{ route('password.request') }}">
									{{ __('locales.passwordRequest') }}
								</a>
							@endif
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
