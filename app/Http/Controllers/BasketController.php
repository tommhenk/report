<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductsRepository;
use Auth;
use App\Http\Requests\OrderRequest;
use App\Models\User;
use App\Models\Order;
class BasketController extends MainController
{
    public function __construct( ProductsRepository $product_rep ){
        parent::__construct(new \App\Repositories\MenusRepository(new \App\Models\Menu));
        $this->product_rep = $product_rep;
        $this->template = config('settings.theme').'.basket.basket';
    }

    public function index($product_id = null){
        $arrContentVars = [];
        if ($product_id) {
            $product = $this->product_rep->one($product_id);
            $arrContentVars['product'] = $product;
        }
        if (Auth::check()) {
            $user = Auth::user();
            $arrContentVars['user'] = $user;
        }
        $this->content = view(config('settings.theme').'.basket.basket_content')->with($arrContentVars)->render();
        return $this->renderOutput();
    }

    private function getProducts(){
        $products = $this->product_rep->get();
        return $products;
    }

    public function order(OrderRequest $request){
        $dataOrder = $request->only('title','desc');
        $status = \App\Models\Status::where('name','new')->first();
        $dataOrder['status_id'] = $status->id;
        $order = new Order($dataOrder);
        


        if (Auth::check()) {
            $user = Auth::user();
            // dd($user->orders());
            $user->orders()->save($order);
            return redirect()->route('index')->with('success','The order was placed successfully');
        }

        $dataUser = $request->except('_token','title','desc');
        $user = new User;
        $user->fill($dataUser);
        if($user->save()){
            $user->roles()->attach(\App\Models\Role::where('name','client')->first()->id);

            $user->orders()->save($order);
            return redirect()->route('index')->with('success','The order was placed successfully');
        }

    }
}















