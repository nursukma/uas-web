<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\menu;
use App\Models\detail_pembelian;

class HomeController extends Controller
{
    private $check;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $check = Auth::check();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user()['role'];
        if($user == 'Admin')
            return redirect('/menu');    

        $check = $this->check;
        
        return view('index', compact('check','user'));
    }

    public function tampilmenu(Request $request){
        $model = menu::get();
        $check = $this->check;
        return view ('pages.menu.index',compact('check','model'));
    }

    public function cart(){
        $user = Auth::user();
        $cart = detail_pembelian::where('id',$user->id)->get();
        return view('cart',compact('cart','user'));
    }

    public function bukacart(){
        
    }
}
