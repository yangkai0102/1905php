<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGoodsPost;
use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;
use App\Admin\Brand;
use App\Admin\Goods;



class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page=request()->page;
        $goodsInfo=Cache::get('goodsInfo'.$page);
//        dump($data);
        if(!$goodsInfo){
            echo 'db';
            $pageSize=config('app.pageSize');
//        dump($query);
//        $where=[];
//        if($query['goods_name']){
//            $where[]=['goods_name','like',"%".$query['goods_name']."%"];
//        }



            $goodsInfo=Goods::join("brand","goods.brand_id","=","brand.brand_id")
                ->join("category","goods.cate_id","=","category.cate_id")
                ->select('goods.*','brand_name','cate_name')
                ->paginate($pageSize);
            Cache::put('goodsInfo'.$page,$goodsInfo,5);
            //        dd($goodsInfo);
        }
        $cateInfo=Category::get();
        $cateInfo=getCateInfo($cateInfo);
        $brandInfo=Brand::get();
        $query=request()->all();

        return view('admin.goods.index',['goodsInfo'=>$goodsInfo,'brandInfo'=>$brandInfo,'cateInfo'=>$cateInfo,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cateInfo=Category::get();
        $cateInfo=getCateInfo($cateInfo);
        $brandInfo=Brand::get();
        return view('admin/goods/create',['cateInfo'=>$cateInfo,'brandInfo'=>$brandInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoodsPost $request)
    {
        //
        $post=$request->except('_token');
//        dd($post);

        if($request->hasFile('goods_img')){
            $post['goods_img']=$this->upload('goods_img');
        }
        $goods=Goods::create($post);
        if($goods->goods_id){
            return redirect('goods/index');
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
        $cateInfo=Category::get();
        $cateInfo=getCateInfo($cateInfo);
        $brandInfo=Brand::get();
        $goodsInfo=Goods::find($id);
        return view('admin.goods.edit',['cateInfo'=>$cateInfo,'brandInfo'=>$brandInfo,'goodsInfo'=>$goodsInfo]);
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
        //判断有无文件上传
        if($request->hasFile('goods_img')){
            $post['goods_img']=$this->upload('goods_img');
        }
//      dd($post);
        Goods::where('goods_id',$id)->update($post);
        return redirect('goods/index');
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
        $res=Goods::destroy($id);
        if($res){
            return redirect('/goods/index');
        }

    }

    public function upload($filename){
        if(request()->file($filename)->isValid()){
            $photo=request()->file($filename);
            $store_result=$photo->store('upload');
            return $store_result;
        }
        exit('未获取到上传文件或上传文件中出错');
    }
}
