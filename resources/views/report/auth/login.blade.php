@extends(config('settings.theme').'.layouts.site')

@section('navigation')
	{!! $navigation !!}
@endsection

@section('content')
<form method="POST" action="{{ route('login') }}">
	@csrf
	<div class="d-flex justify-content-between">
		<h1 class="h3 mb-3 fw-normal">Login to access</h1>
		<h1 class="h3 mb-3 fw-normal"><a href="{{ route('register') }}">Register</a></h1>
	</div>

    <div class="form-floating mb-3 ">
      <input type="text" name="login" class="form-control" id="login" placeholder="Login">
      <label for="login">Your login</label>
    </div>
    <div class="form-floating mb-3 ">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      <label for="password">Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
  </form>
@endsection