<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactsController extends MainController
{
    public function __construct(){
        parent::__construct(new \App\Repositories\MenusRepository(new \App\Models\Menu));
        $this->template = config('settings.theme').'.contacts.contacts';
    }


    public function index(){

        $this->content = view(config('settings.theme').'.contacts.contacts_content')->render();
        return $this->renderOutput();
    }
}
