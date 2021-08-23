<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\MenusRepository;
use Arr;
use Menu;
use Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    protected $template;
    protected $vars = [];

    protected $menu_rep;
    protected $content;

    protected $order_rep;
    protected $client_rep;
    protected $employee_rep;
    protected $product_rep;

    protected $monthSalary = 500;

    public function __construct(){
        $this->middleware(function($request, $next){
            if (Auth::check()) {
                return $next($request);
            }
            abort(403);
        });
    }

    public function renderOutput(){
        // dd(Auth::user()->canDo('ORDER_ADMIN'));

        $mBuilder = $this->getMenu();
        // dd($mBuilder);
        $navigation = view(config('settings.theme').'.navigation')->with('menu', $mBuilder)->render();
        $this->vars = Arr::add($this->vars, 'navigation', $navigation);

        if ($this->content) {

            $this->vars = Arr::add($this->vars, 'content', $this->content);
        }
        return view($this->template)->with($this->vars);
    }

    public function getMenu(){
        $mBuilder = Menu::make('AdminNavigation', function ($m){
                if (Gate::allows('ORDER_ADMIN')) {
                    $m->add('Orders', ['route'=>'admin_orders_index']);
                }

                // if (Gate::allows('CLIENT_ADMIN')) {
                //     $m->add('Clients', ['route'=>'admin_clients_index']);
                // }
                if (Gate::allows('EMPLOYEE_ADMIN')) {
                    $m->add('Income And Costs', ['route'=>'admin_income_index']);
                }
                // if (Gate::allows('EMPLOYEE_ADMIN')) {
                //     $m->add('Costs', ['route'=>'admin_costs_index']);
                // }
                if (Gate::allows('EMPLOYEE_ADMIN')) {
                    $m->add('Employees', ['route'=>'admin_employees_index']);
                }
                
                $m->add('Main', ['route'=>'index']);
                
                
                
            
        });
        return $mBuilder;
    }
}
