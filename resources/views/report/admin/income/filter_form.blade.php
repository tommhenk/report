
<form class="row g-3 mb-4" method="GET" action="{{ route('admin_income_index') }}">
  <div class="col-md-4">
    <label for="start" class="form-label">Start period</label>
    <input type="text" name="start" class="form-control" id="start" value="{{ request()->has('start') ? request()->start : '' }}">
  </div>
  <div class="col-md-4">
    <label for="finish" class="form-label">End of period</label>
    <input type="text" name="finish" class="form-control" id="finish" value="{{ request()->has('finish') ? request()->finish : '' }}">
  </div>
  
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Submit form</button>
  </div>
</form>




<script>
$(function(){
	$("#start").datepicker();
	$("#finish").datepicker();
});
</script>