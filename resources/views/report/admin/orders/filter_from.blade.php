@if ($products)
<form class="row g-3 mb-4" method="GET" action="{{ route('admin_orders_index') }}">
  <div class="col-md-4">
    <label for="start" class="form-label">Start period</label>
    <input type="text" name="start" class="form-control" id="start" value="{{ request()->has('start') ? request()->start : '' }}">
  </div>
  <div class="col-md-4">
    <label for="finish" class="form-label">End of period</label>
    <input type="text" name="finish" class="form-control" id="finish" value="{{ request()->has('finish') ? request()->finish : '' }}">
  </div>
  <div class="col-md-4">
  	@foreach ($products as $key=>$prod)
  		<div class="form-check">
		  <input class="form-check-input" name="{{ $key }}" type="checkbox" value="{{$key}}" id="{{$key}}" {{ request()->has($key) ? 'checked' : ''}}>
		  <label class="form-check-label" for="{{ $key }}">
		    {{$prod}}
		  </label>
		</div>
  	@endforeach
  </div>
  
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Submit form</button>
  </div>
</form>
@endif



<script>
$(function(){
	$("#start").datepicker();
	$("#finish").datepicker();
});
</script>