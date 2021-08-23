@if ($items)
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
  	@if ($items->currentPage() > 1)
  		<li class="page-item">
	      <a class="page-link" href="{{ $items->previousPageUrl() }}"><<</a>
	    </li>
  	@endif
    @for ($i = 1; $i <= $items->lastPage(); $i++)
    	<li class="page-item {{ ($items->currentPage() == $i) ? 'active' : '' }}"><a class="page-link" href="{{ $items->url($i) }}">{{ $i }}</a></li>
    @endfor
    @if ($items->currentPage() < $items->lastPage())
  		<li class="page-item">
	      <a class="page-link" href="{{ $items->nextPageUrl() }}">>></a>
	    </li>
  	@endif
  </ul>
</nav>
@endif