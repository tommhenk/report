@if ($orders)
@include(config('settings.theme').'.pagination', ['items'=>$orders])
	<table class="table table-striped table-hover">
 		<thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Name</th>
	      <th scope="col">Price</th>
	      <th scope="col">Status</th>
	      <th scope="col">Client</th>
	      <th scope="col">Employee</th>
	      <th scope="col">date</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach ($orders as $order)
	  	<tr   @if($order->status->name == 'fulfilled')
				 class="table-success"
				@elseif($order->status->name == 'in_process')
				class="table-warning"
				@else
				 class="table-danger"
				 @endif
	  		>
	      <th scope="row">{{ $loop->iteration }}</th>
	      <td>{{ isset($order->title) ? $order->title : $order->product->title }}</td>
	      <td>{{ isset($order->price) ? $order->price : $order->product->price }}</td>
	      <td>{{ $order->status->name }}</td>
	      <td>{{ $order->client->name }}</td>
	      <td>{{ $order->employee->name }}</td>
	      <td>{{ $order->created_at->format('Y-m-d') }}</td>
	    </tr>
	  	@endforeach
	  </tbody>
	</table>
	@include(config('settings.theme').'.pagination', ['items'=>$orders])
@endif

