<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryPost;
use Illuminate\Http\Request;
use App\Admin\Category;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cateInfo=Category::get();
        $cateInfo=getCateInfo($cateInfo);
//        dd($cateInfo);
        return view('admin.category.index',['cateInfo'=>$cateInfo]);
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
//        dd($cateInfo);
        return view('admin/category/create',['cateInfo'=>$cateInfo]);
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
        $category=Category::create($post);
        if($category->cate_id){
            return redirect('admin.category.index');
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
        $data=Category::find($id);
        return view('admin.category.edit',['data'=>$data,'cateInfo'=>$cateInfo]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryPost $request, $id)
    {
        //
        $post=$request->except('_token');
//        dd($post);
        $res=Category::where('cate_id',$id)->update($post);
            return redirect('category/index');
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
        $res=Category::destroy($id);
        if($res){
            return redirect('category/index');
        }

    }
}
