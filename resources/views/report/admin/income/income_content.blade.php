@if($arr)
    <ul class="list-group list-group-flush">
	  <li class="list-group-item">Full Costs : {{ $arr['Full costs'] }}</li>
	  <li class="list-group-item">Full income : {{ $arr['Full income'] }}</li>
	  <li class="list-group-item">Product 1 : income - {{ $arr['Product 1']['sum'] }}/orders - {{ $arr['Product 1']['count'] }}</li>
	  <li class="list-group-item">Product 2 : income - {{ $arr['Product 2']['sum'] }}/orders - {{ $arr['Product 2']['count'] }}</li>
	  <li class="list-group-item">Product 3 : income - {{ $arr['Product 3']['sum'] }}/orders - {{ $arr['Product 3']['count'] }}</li>
	  <li class="list-group-item">own product : income - {{ $arr['own product']['sum'] }}/orders - {{ $arr['own product']['count'] }}</li>
	</ul>
@endif
