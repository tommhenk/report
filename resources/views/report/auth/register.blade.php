@extends(config('settings.theme').'.layouts.site')

@section('navigation')
	{!! $navigation !!}
@endsection

@section('content')
<form method="POST" action="{{ route('register') }}">
	@csrf
	<div class="d-flex justify-content-between">
		<h1 class="h3 mb-3 fw-normal">Register</h1>
	</div>

    <div class="form-floating mb-3 ">
      <input type="text" name="login" class="form-control" id="login" placeholder="Login"value="{{ old('login') }}">
      <label for="login">Your login</label>
    </div>
    <div class="form-floating mb-3 ">
      <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
      <label for="name">Name</label>
    </div>
    <div class="form-floating mb-3 ">
      <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}">
      <label for="email">Email</label>
    </div>
    <div class="form-floating mb-3 ">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      <label for="password">Password</label>
    </div>
    <div class="form-floating mb-3 ">
      <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password">
      <label for="password">Password confirmation</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
  </form>
@endsection