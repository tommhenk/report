<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends AdminController
{
    public function __construct(){
        parent::__construct();
        $this->template = config('settings.theme').'.admin.index';
    }

    public function index(){

        $this->content = 'Main page';

        return $this->renderOutput();
    }
}
