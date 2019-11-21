<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandPost;
use Illuminate\Http\Request;
use DB;
use App\Admin\Brand;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Cache;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $data=DB::table('brand')->get();

        $page=request()->page;
        $word=request()->word;

        $data=Cache::get('data_'.$page.'_'.$word);
//        dump($data);
        if(!$data){
            echo 'db===';
            //ORM  get
            $pageSize=config('app.pageSize');

            //搜索品牌名称
            $word=request()->word;
            $where=[];
            if($word){
                $where[]=['brand_name','like',"%$word%"];
            }
            //搜索品牌备注
            $desc=request()->desc;
            if($desc){
                $where[]=['brand_desc','like',"%$desc%"];
            }


            $data=Brand::where($where)->paginate($pageSize);

            Cache::put('data_'.$page.'_'.$word,$data,60);
        }

//        DB::connection()->enableQueryLog();
//        $data =  DB::table('brand')->where($where)->paginate($pageSize);
//        $logs = DB::getQueryLog();
//        dd($logs);

        $query=request()->all();
//        dd($data);
        return view('admin/brand/index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
//        echo 111;
        return view('admin/brand/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //第二种验证
//    public function store(StoreBrandPost $request)
    public function store(Request $request)
    {
        //第一种验证
//        $request->validate([
//            'brand_name'=>'required|unique:brand',
//            'brand_url'=>'required',
//        ],[
//            'brand_name.required'=>'品牌名称必填',
//            'brand_name.unique'=>'品牌名称已存在',
//            'brand_url.required'=>'品牌网址必填'
//        ]);

        //
//        $post=$request->post();
//        dd($post);
//        unset($post['_token']);
//        $res=DB::table('brand')->insert($post);//返回bool值
//
        //接收排除_token 的值
        $post=$request->except('_token');

        //第三种
        $validator=\Validator::make($post,[
            'brand_name'=>'required|unique:brand',
            'brand_url'=>'required',
        ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_url.required'=>'品牌网址必填'
        ]);
        if($validator->fails()){
            return redirect('/brand/create')
                ->withErrors($validator)
                ->withInput();
        }

//        dd($post);
        //只接收某个字段 的值
//        $post=$request->only('_token');
//        $res=DB::table('brand')->insertGetId($post);//返回自增id

        //文件上传
        if($request->hasFile('brand_logo')){
            $post['brand_logo']=$this->upload('brand_logo');
        }
//        dd($post);

        //ORM添加
        $brand=Brand::create($post);

        //        $brand=new Brand;
//        $brand->brand_name=$post['brand_name'];
//        $brand->brand_logo=$post['brand_logo'];
//        $brand->brand_url=$post['brand_url'];
//        $brand->brand_desc=$post['brand_desc'];
//        $brand->save();
        if($brand->brand_id){
            return redirect('/brand/index');
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
        //DB  单条查询
        $data=DB::table('brand')->where('brand_id',$id)->first();

        //ORM 单条查询
//        $data=Brand::find($id);
        $data=Brand::where('brand_id',$id)->first();
        return view('/admin/brand/edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBrandPost $request, $id)
    {
        //验证

        //接值

        $post=$request->except('_token');
//        dd($post);
        //判断有无文件上传
        if($request->hasFile('brand_logo')){
            $post['brand_logo']=$this->upload('brand_logo');
        }
        //更新入库
        $res=Brand::where('brand_id',$id)->update($post);
        return redirect('/brand/index');
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
//        echo $id;die;
        if(!$id){
            abort(404);
        }
        //Db
//        $res=DB::table('brand')->where('brand_id',$id)->delete();

        //ORM
        $res=Brand::destroy($id);
//        $res=Brand::where('brand_id',$id)->delete();
//        dd($res);
        if($res){
            return redirect('/brand/index');
        }
    }

    function upload($filename){
        if(request()->file($filename)->isValid()){
            $photo=request()->file($filename);
            $store_result=$photo->store('upload');
            return $store_result;
        }
        exit('未获取到上传文件或上传文件中出错');
    }
}
