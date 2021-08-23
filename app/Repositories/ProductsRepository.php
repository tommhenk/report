<?php

namespace App\Repositories;
use App\Models\Product;

class ProductsRepository extends Repository
{
	public function __construct(Product $product){
		$this->model = $product;
	}
}