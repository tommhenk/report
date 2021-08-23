@if (isset($employees))
@include(config('settings.theme').'.pagination', ['items'=>$employees])
	<table class="table table-striped table-hover">
 		<thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Name</th>
	      <th scope="col">Orders count</th>
	      <th scope="col">Orders Sum Price</th>
	      <th scope="col">Salary</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach ($employees as $employee)
	  	<tr>
	      <th scope="row">{{ $loop->iteration }}</th>
	      <td>{{ $employee['name'] }}</td>
	      <td>{{ $employee['countOrders'] }}</td>
	      <td>{{ $employee['ordersSum'] }}</td>
	      <td>{{ $employee['salaryForPeriod'] }}</td>
	    </tr>
	  	@endforeach
	  </tbody>
	</table>
	@include(config('settings.theme').'.pagination', ['items'=>$employees])
@endif

