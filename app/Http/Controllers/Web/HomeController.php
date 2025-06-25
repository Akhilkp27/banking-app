<?php

namespace App\Http\Controllers\Web;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    
   public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('guest');
        $this->addBaseRoute('home');
        $this->addBaseView('home');
    }
    public function index()
    {
       $path = $this->getView('index');
        $para = [];
        $title = 'Home';
      
        return $this->renderView($path, compact($para), $title); 
      
    }
    public function register()
    {
         $path = $this->getView('register');
        $para = [];
        $title = 'Register';
      
        return $this->renderView($path, compact($para), $title); 
    }
    public function store(Request $request)
    {
        User::create([
            'name' => $request->first_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
       
        return redirect()->route($this->getRoute('index'));
    }
}