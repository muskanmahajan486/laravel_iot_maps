<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class dataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(!Session::get('login')){
        return redirect('/user/login')->with('alert','Kamu harus login dulu');
      }
      $username = Session('name');
      $user = User::where('name',$username)->first();
      $data = Data::where('id_user',$user->id)->get();
     
      return view('maps.index',
          [
            'user'=>$user,
            'data'=>$data,
          ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $name = $request->name;
      $username = User::where('name',$name)->first();

      if(!$username){
        return response()->json([
          'name' => $name,
          'description' => 'Tidak terdaftar',
        ]);
      }
      else{
          $data =  new Data();
          // dd($username->id);
          $data->id_user = $username->id;
          $data->id_car = $request->id_car;
          $data->btn_empty = $request->btn_empty;
          $data->btn_filled = $request->btn_filled;
          $data->btn_loading = $request->btn_loading;
          $data->btn_trash = $request->btn_trash;
          $data->longitude = $request->longitude;
          $data->latitude  = $request->latitude;
          $data->xgyro = $request->xgyro;
          $data->ygyro = $request->ygyro;
          $data->temp = $request->temp;
          $data->save();
          return redirect('login')->with('alert-success','Pendaftaran berhasil');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
