@if ($products)
<div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

  @foreach ($products as $item)

      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">{{$item->title}}</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">${{ $item->price }}</h1>
            <p class="mt-3 mb-4">{{ $item->desc }}</p>
            <button type="button" class="w-100 btn btn-lg btn-outline-primary">
              <a href="{{ route('basketIndex', ['product_id'=>$item->id]) }}">Buy</a>
            </button>
          </div>
        </div>
      </div>
  @endforeach
</div>

<h2 class="display-6 text-center mb-4"><a href="{{ route('basketIndex') }}" class="btn btn-primary col-4">Add task</a></h2>


@endif