<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrderFilterRequest;
use Auth;
use Arr;
use Illuminate\Support\Facades\Gate;
use App\Repositories\OrdersRepository;
use App\Repositories\ProductsRepository;
use App\Models\Calc;

class OrdersController extends AdminController
{
    public function __construct( OrdersRepository $order, ProductsRepository $product ){
        parent::__construct();
        $this->middleware(function($request, $next){
            if (Gate::allows('ORDER_ADMIN')) {
                return $next($request);
            }
            abort(403);
        });
        $this->order_rep = $order;
        $this->product_rep = $product;
        $this->template = config('settings.theme').'.admin.orders.orders';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( OrderFilterRequest $request )
    {
        // dd($request->all());
        $orders = $this->getOrders( $request );
        $data['orders'] = $orders;
        // dd($orders);
        $products = $this->getProducts();
        $data['products'] = $products;
        // dd($products);
        $filters = view(config('settings.theme').'.admin.orders.filter_from')->with($data)->render();
        $this->vars = Arr::add($this->vars, 'filters' ,$filters);
        $this->content = view(config('settings.theme').'.admin.orders.orders_content')->with($data)->render();
        return $this->renderOutput();
    }

    public function getOrders( $request ){
        $orders = '';
        if (empty($request->except('page'))) {
            return $orders = $this->order_rep->get('*',false, 100);
        }else{
            $arrCheckbox = ["own" => "own",
                  "1" => "1",
                  "2" => "2",
                  "3" => "3"];
            $builder = \App\Models\Order::select();

            if(!$request->filled('finish')){
                $finish = date('Y-m-d H:i:s', time());
            }else{
                $finish = date('Y-m-d H:i:s', strtotime($request->finish));
            }
            // dd($finish);
            $builder->where('created_at', '<=', $finish);

            if(!$request->filled('start')){
                $start = date('Y-m-d H:i:s', 0);
            }else{
                $start = date('Y-m-d H:i:s', strtotime($request->start));
            }
            $builder->where('created_at', '>=', $start);

            // $costs = $this->costsCalculate($builder, $start, $finish);
            // $calculator = new Calculator($builder, $start, $finish, 500);
            $calculator = new Calc(new \App\Models\Order, $start, $finish, 500);
            // dd($calculator->costs);    
            // $costs = $calculator->costsCalculate();
            // dd($costs);
            foreach ($arrCheckbox as $key => $value) {
                if ($request->filled($key)) {
                    if ($key == "own") {
                        // dd(1);   
                        $builder->where('product_id', null);
                    }else{
                        $builder->where('product_id', $value);
                    }
                }
                
            }
            
            $orders = $builder->paginate(100)->withPath('orders?'.$request->getQueryString());
        }
        
        $orders->load('status','product','client','employee');
        return $orders;
    }

    public function getProducts(){
        $products = $this->product_rep->get();
        $products = $products->reduce(function ($returnArr, $product){
            $returnArr[$product->id] = $product->title;
            return $returnArr;
        }, ['own'=>'client\'s product']);
        return $products;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
