<?php

namespace App\Repositories;
use App\Models\Order;

class OrdersRepository extends Repository
{
	public function __construct(Order $order){
		$this->model = $order;
	}
}