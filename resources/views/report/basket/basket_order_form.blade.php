<form action="{{ route('makeOrder') }}" method="POST">

  @csrf
  @if (isset($product))
    <input type="hidden" name="product_id" value={{$product->id}}>
  @endif
  @if (!isset($product))
    @include(config('settings.theme').'.basket.basket_product_form')
  @endif
  @if (!isset($user))
    @include(config('settings.theme').'.basket.un_auth_user_form')
  @endif
  
  <div class="mb-3">
    <button class="btn btn-primary">Send request</button>
  </div>
</form>