<?php

namespace App\Models;

class Calculator {

	protected $builder;
	protected $start;
	protected $finish;
	protected $monthlySalary;
	protected $model;

	public function __construct($builder, $start, $finish, $monthlySalary, $model = false ){
		$this->builder = $builder;
		$this->start = $start;
		$this->finish = $finish;
		$this->monthlySalary = $monthlySalary;
		if ($model) {
			$this->model = $model;
		}
	}

    public function costsCalculate($builder, $start, $finish){
	    $orders = $builder->get();
	    $orders = $orders->transform(function ($order, $key){
	        if (empty($order->price)) {
	            $order->price = $order->product->price;
	        }
	        return $order;
	    });
	    $employeesWithOrders = collect($orders->groupBy('employee_id')->all());
	    // dd($employeesWithOrders);
	    $employeesWithCountAndSalary = $employeesWithOrders->transform(function($ordersEmployee, $key){
	        return $key = ['countOrders'=>$ordersEmployee->count(), 'prdersSum'=>$ordersEmployee->sum('price')];
	    });
	    dd($employeesWithCountAndSalary);

	    $ordersCollection = $orders->toArray();
	    $sumOrders = $orders->sum('price');
	    $salaryForPeriod = $this->calculateSalary($start, $finish, 500);
	    $costs = $sumOrders*0.03 + count($employees)*$salaryForPeriod;
	    return ['costs'=>$costs, 'income'=>$sumOrders];
    }
    //calculate salary from start of month
    public function calculateSalary($start, $finish, $monthlySalary){
        if(strtotime($start) < strtotime($finish)){
            [$yearStart, $monthStart, $dayStart] = explode('-',date('Y-n-j', strtotime($start)));
            [$yearFinish, $monthFinish, $dayFinish] = explode('-',date('Y-n-j', strtotime($finish)));
            if ($yearStart == $yearFinish && $monthStart == $monthFinish && $dayStart < $dayFinish ) {
                return ($dayFinish - $dayStart)*$this->salaryPerDay($yearStart, $monthStart, $monthlySalary);
            }
            elseif ($yearStart == $yearFinish && $monthStart < $monthFinish) {
                $differMonth = $monthFinish - $monthStart;
                if ($differMonth == 1) {
                    $partPreviousSalary = $this->partPrevSalary($start, $monthlySalary);

                    $partRestSalary = $this->partRestSalary($finish, $monthlySalary);
                    return $partPreviousSalary + $partRestSalary;
                }elseif ($differMonth > 1) {
                    $partPreviousSalary = $this->partPrevSalary($start, $monthlySalary);
                    $salaryForMonthes = ($differMonth - 1) * $monthlySalary;
                    $partRestSalary = $this->partRestSalary($finish, $monthlySalary);
                    return $partPreviousSalary + $salaryForMonthes + $partRestSalary;
                }
            }elseif ($yearStart < $yearFinish) {
                $differYear = $yearFinish - $yearStart;
                if($differYear == 1){
                    $partPrevYearMonthSalary = $this->partPrevSalary($start, $monthlySalary);
                    $partRestPrevYearMonthSalary = (12 - $monthStart - 1)*$monthlySalary;

                    $partYearMonthSalary = $monthFinish * $monthlySalary;
                    $partYearMonthSalary2 = $this->partRestSalary($finish, $monthlySalary);
                    return $partPrevYearMonthSalary + $partRestPrevYearMonthSalary + $partYearMonthSalary + $partYearMonthSalary2;
                }
                elseif ($differYear > 1) {
                    $partPrevYearMonthSalary = $this->partPrevSalary($start, $monthlySalary);
                    $partRestPrevYearMonthSalary = (12 - $monthStart - 1)*$monthlySalary;

                    $yearsSalary = 12*($differYear - 1)*$monthlySalary;

                    $partYearMonthSalary = $monthFinish * $monthlySalary;
                    $partYearMonthSalary2 = $this->partRestSalary($finish, $monthlySalary);
                    return $partPrevYearMonthSalary + $partRestPrevYearMonthSalary + $partYearMonthSalary + $partYearMonthSalary2;
                }
            }

        }


    }

    public function partRestSalary($finish, $monthlySalary){
       [$yearFinish, $monthFinish, $dayFinish] = explode('-',date('Y-n-j', strtotime($finish)));
       return $dayFinish * $this->salaryPerDay($yearFinish, $monthFinish, $monthlySalary);
   }

   public function partPrevSalary($start, $monthlySalary){
       [$yearStart, $monthStart, $dayStart] = explode('-',date('Y-n-j', strtotime($start)));
       $daysToEndOfMonth = date('t', mktime(0,0,0,$monthStart)) - $dayStart;
       return $daysToEndOfMonth * $this->salaryPerDay($yearStart, $monthStart, $monthlySalary);
   }

  

   public function daysInMonth($year, $month){
       return date('t', mktime(0,0,0,$month, 1, $year));
   }

   public function salaryPerDay($year, $month, $monthlySalary){
       return $monthlySalary / $this->daysInMonth($year, $month);
   }
}