<div class="d-grid gap-2 mb-3">
  <button class="btn btn-outline-primary" type="button"><a href="{{ route('index') }}">Change preference</a></button>
</div>
@if (isset($product))
	@include(config('settings.theme').'.basket.basket_product_cart', ['product'=>$product])
@endif


@include(config('settings.theme').'.basket.basket_order_form')
