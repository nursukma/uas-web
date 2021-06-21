<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\menu;
use DataTables;
use Auth;
use Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // dd($cek = Auth::user());
    }
    public function index()
    {
        $user = Auth::user()['role'];
        $check = Auth::check();
        // dd($check);
        return view('pages.menu.admin',compact('user','check'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = null;
        $user = Auth::User();
        return view('pages.menu.form',compact('model','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->nama_menu);
        $request->validate([
            'nama_menu'=>'required|string|max:255',
            'harga'=>'required|integer',
            'jumlah'=>'required|integer',
            'keterangan'=>'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',        
            ]);
        $imageName = time().'.'.$request->photo->extension();
        $request->photo->move(public_path('images/menu'), $imageName);
        menu::create([
            'nama_menu'=>$request->nama_menu,
            'harga'=>$request->harga,
            'jumlah'=>$request->jumlah,
            'photo'=> $imageName,
            'keterangan'=>$request->keterangan,
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = menu::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = menu::findOrFail($id);
        $user = Auth::user();
        return view('pages.menu.form',compact('model','user'));
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
        $request->validate([
            'nama_menu'=>'required|string|max:255',
            'harga'=>'required|integer',
            'jumlah'=>'required|integer',
            'keterangan'=>'required|string|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',        
            ]);
        $imageName = $request->photo;
        if($request->photo != null){
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images/menu'), $imageName);
        }
        $model = menu::findOrFail($id);
        $model->update([
            'nama_menu'=>$request->nama_menu,
            'harga'=>$request->harga,
            'jumlah'=>$request->jumlah,
            'photo'=> $imageName,
            'keterangan'=>$request->keterangan,
        ]);

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = menu::findOrFail($id);
        $model->delete();
    }

    public function table(){
        // echo "<script>console.log('masuk')</script>";
        // dd("test");
        $model = menu::query();
            return DataTables::of($model)
                ->addColumn('action',function($model){
                    return view('layouts._action',[
                        'model'=>$model,
                        // 'url_show'=>route('product.show',$model->id),
                        'url_edit'=>route('menu.edit',$model->id_menu),
                        'url_destroy'=>route('menu.destroy',$model->id_menu)
                    ]
                );
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
}
