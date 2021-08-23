<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MenusRepository;
use Arr;
use Menu;
use Auth;
use App\Models\User;

class MainController extends Controller
{
    protected $template;
    protected $vars = [];

    protected $menu_rep;
    protected $content;

    protected $order_rep;
    protected $client_rep;
    protected $employee_rep;
    protected $product_rep;

    public function __construct( MenusRepository $menu ){
        $this->middleware(function($request, $next){
            if (!\Schema::hasTable('users')) {
                // dd(!\Schema::hasTable('users'));
                return redirect()->route('seeder');
            }
            return $next($request);
        });
        
        $this->menu_rep = $menu;
        
    }

    public function renderOutput(){
        // dd(url('/'));

        // dd(1);
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
        $menu = $this->menu_rep->get();
        $mBuilder = Menu::make('MyNavigation', function ($m) use($menu){
            foreach ($menu as $item) {
                $m->add($item->name, url($item->path));
            }
            if (!Auth::check()) {
                $m->add('Login', url('/login'));
            }
        });
        return $mBuilder;
    }
}
