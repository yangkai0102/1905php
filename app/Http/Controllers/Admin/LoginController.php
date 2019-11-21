<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Admin;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/login/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        //
        $post=$request->except('_token');
//        dd($post);

        $validator=\Validator::make($post,[
            'admin_name'=>'required',
            'admin_pwd'=>'required',
        ],[
            'admin_name.required'=>'用户名必填',

            'admin_pwd.required'=>'密码必填'
        ]);
        if($validator->fails()){
            return redirect('/login/create')
                ->withErrors($validator)
                ->withInput();
        }
        $where=[
            ['admin_name','=',$post['admin_name']],
            ['admin_pwd','=',md5($post['admin_pwd'])]
        ];

        $user=Admin::where($where)->count();
//        dd($user);
        if($user=1){
            session(['admin'=>$user]);
            return redirect('/goods/index');
        }else{
            return redirect('/login/create')->with('msg','账号或密码错误');
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
