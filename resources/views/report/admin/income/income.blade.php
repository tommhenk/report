@extends(config('settings.theme').'.layouts.admin')

@section('navigation')
	{!! $navigation !!}
@endsection

@section('filters')
	{!! $filters !!}
@endsection

@section('content')
	{!! $content !!}
@endsection