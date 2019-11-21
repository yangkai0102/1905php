<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Admin\Admin;
use App\Admin\Student;
class AdminController extends Controller
{
    public function student(){
        $page=request()->page;
        $data=cache('data_'.$page);
        if(!$data){
            echo "db数据库";

            $data=Student::paginate(2);
            cache(['data_'.$page=>$data],10);
        }
        return view('admin/student',['data'=>$data]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $pageSize=config('app.pageSize');
        //搜索
        $word=request()->word;
        $where=[];
        if($word){
            $where[]=['admin_name','like',"%$word%"];
        }
        $data=Admin::where($where)->paginate($pageSize);
        cache(['data'=>$data],10);
        $query=request()->all();
        return view('admin/admin/index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.admin.create');
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
//        $request->validate([
//            'admin_name'=>'required|unique:admin',
//            'admin_email'=>'required',
//        ],[
//            'admin_name.required'=>'管理员名称必填',
//            'admin_name.unique'=>'管理员名称已存在',
//            'admin_email.required'=>'邮箱必填'
//        ]);
        $post=$request->except('_token');
//        dd($post);
        $validator=\Validator::make($post,[
            'admin_name'=>'required|unique:admin',
            'admin_email'=>'required',
        ],[
            'admin_name.required'=>'管理员名称必填',
            'admin_name.unique'=>'管理员名称已存在',
            'admin_email.required'=>'邮箱必填'
        ]);
        if($validator->fails()){
            return redirect('/admin/create')
                ->withErrors($validator)
                ->withInput();
        }

        $post['admin_pwd']=md5($post['admin_pwd']);
//        $res=DB::table('admin')->insert($post);
        $admin=Admin::create($post);
        if($admin->admin_id){
            return redirect('admin/index');
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
        if(!$id){
            return;
        }
        $data=Admin::find($id);
        return view('admin/admin/edit',['data'=>$data]);
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
        $post=$request->except('_token');
//        dd($post);

        //更新入库
        $res=Admin::where('admin_id',$id)->update($post);
        return redirect('/admin/index');

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
        if(!$id){
            abort(404);
        }
        $res=Admin::destroy($id);
        if($res){
            return redirect('admin/index');
        }
    }
}
