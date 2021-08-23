<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Arr;
use Illuminate\Support\Facades\Gate;
use App\Repositories\OrdersRepository;
use App\Repositories\ProductsRepository;
use App\Models\Calc;

class IncomeController extends AdminController
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
        $this->template = config('settings.theme').'.admin.income.income';
    }

    public function index( Request $request )
    {
        // dd($request->all());
        // dd($orders);
        // dd($products);
        $filters = view(config('settings.theme').'.admin.income.filter_form')->render();
        $this->vars = Arr::add($this->vars, 'filters' ,$filters);
        $arr = $this->getResultArr($request);

        $this->content = view(config('settings.theme').'.admin.income.income_content')->with('arr', $arr)->render();
        // dd($this->content);
        return $this->renderOutput();
    }

    public function getResultArr($request){
        $calculator = $this->getCalculator($request);
        $products = $this->getProducts();
        $resArr = [];
        $income = $calculator->income;
        if ($income) {
            $resArr['Full income'] = $income;
        }
        $costs = $calculator->costs;
        if ($costs) {
            $resArr['Full costs'] = ceil($costs);
        }

        $incomesFromEachProduct = $calculator->incomes;

        foreach ($incomesFromEachProduct as $id => $arr) {
            if (empty($id)) {
                $resArr['own product'] = $arr;
            }else{
                $resArr[$products[$id]] = $arr;
            }
        }
        return $resArr;

    }

    public function getCalculator( $request ){
        if(!$request->filled('finish')){
            $finish = date('Y-m-d H:i:s', time());
        }else{
            $finish = date('Y-m-d H:i:s', strtotime($request->finish));
        }

        if(!$request->filled('start')){
            $start = date('Y-m-d H:i:s', 0);
        }else{
            $start = date('Y-m-d H:i:s', strtotime($request->start));
        }

        $calculator = new Calc(new \App\Models\Order, $start, $finish, 500);

        return $calculator;
        
            
    }

    public function getProducts(){
        $products = $this->product_rep->get();
        $products = $products->reduce(function ($returnArr, $product){
            $returnArr[$product->id] = $product->title;
            return $returnArr;
        }, ['own product'=>'client\'s product']);
        return $products;
    }
}
