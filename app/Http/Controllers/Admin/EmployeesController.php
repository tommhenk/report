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
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeesController extends AdminController
{
    public function __construct( OrdersRepository $order, ProductsRepository $product ){
        parent::__construct();
        $this->middleware(function($request, $next){
            if (Gate::allows('EMPLOYEE_ADMIN')) {
                return $next($request);
            }
            abort(403);
        });
        $this->order_rep = $order;
        $this->product_rep = $product;
        $this->template = config('settings.theme').'.admin.employees.employees';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = view(config('settings.theme').'.admin.employees.employees_filter_form')->render();
        $this->vars = Arr::add($this->vars, 'filters' ,$filters);
        $employees = $this->getEmployees( $request);
        // dd($employees);
        $this->content = view(config('settings.theme').'.admin.employees.employees_contetn')->with('employees',$employees)->render();
        return $this->renderOutput();
    }

    private function getCalculator( Request $request ){

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

        $calculator = new Calc(new \App\Models\Order, $start, $finish, $this->monthSalary);

        return $calculator;
    }

    private function getEmployees( $request ){
        $employees = $this->getCalculator($request)->employees;
        $employeeIds = $employees->keys();
        $employeeNames = User::whereIn('id', $employeeIds)->select('id','name')->get()->groupBy('id');
        
        $employees->transform(function($employee, $key) use ($employeeNames){
            $employee['id'] = $key;
            $employee['name'] = $employeeNames[$key][0]->name;
            $employee['salaryForPeriod'] = ceil($employee['salaryForPeriod']);
            return $employee;
        });
        return new LengthAwarePaginator($employees, $employees->count(), 10);
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
