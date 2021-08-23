<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['title','desc','price','status_id','client_id','employee_id','product_id'];


    public function client(){
        return $this->belongsTo(User::class, 'client_id', 'id');
    }
    public function employee(){
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
