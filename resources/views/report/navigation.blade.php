@if ($menu)
<nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        @foreach ($menu->all() as $item)
                <a class="me-3 py-2 text-dark text-decoration-none {{ ($item->url() == url()->current()) ? 'active' : '' }}" href="{{ $item->url() }}">{{ $item->title }}</a>
        @endforeach
        @if (Route::currentRouteName() == 'index')
            <a class="me-3 py-2 text-dark text-decoration-none {{ (Route::currentRouteName() == 'index') ? 'active' : '' }}" href="{{ route('adminIndex') }}">Admin panel</a>
        @elseif(Route::currentRouteName() == 'adminIndex')
            <a class="me-3 py-2 text-dark text-decoration-none {{ (Route::currentRouteName() == 'adminIndex') ? 'active' : '' }}" href="{{ route('index') }}">Main</a>
        @endif
        @if (Auth::check())
        {!! Form::open(['url'=>route('logout'), 'method'=>'POST']) !!}
            <a class="me-3 py-2 text-dark text-decoration-none" onclick="function(this){this.preventDefault()}" href="#"><button type="submit">Logout: {{ Auth::user()->login }}
            </button></a>
        {!! Form::close() !!}

        @endif
</nav>
@endif
