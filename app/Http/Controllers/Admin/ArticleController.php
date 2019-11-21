<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Cate;

class ArticleController extends Controller
{
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
        $article_title=request()->article_title;
        $cate_id=request()->cate_id;
        $where=[];
        if($article_title){
            $where[]=['article_title','like',"%$article_title%"];
        }
        if($cate_id){
            $where[]=['cate.cate_id','=',"$cate_id"];
        }

        $cateInfo = Cate::get();
        $query=request()->all();

        $articleInfo= Article::join('cate','article.cate_id','=','cate.cate_id')->where($where)->paginate($pageSize);
//        dd($articleInfo);
        return view('admin/article/index',['articleInfo'=>$articleInfo,'cateInfo'=>$cateInfo,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cateInfo = Cate::get();
//        dd($cateInfo);
        return view('admin/article/create',['cateInfo'=>$cateInfo]);
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
//        验证

        //第一种验证
        $request->validate([
            'article_title'=>'required|unique:article',
        ],[
            'article_title.required'=>'标题必填',
            'article_title.unique'=>'标题已存在',
        ]);
        //上传
        if($request->hasFile('article_file')){
            $post['article_file']=$this->upload('article_file');
        }
        $post['create_time']=time();
        $data=Article::create($post);
        if($data->article_id){
            return redirect('article/index');
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
        $cateInfo = Cate::get();
        $articleInfo=Article::find($id);
        return view('admin/article/edit',['articleInfo'=>$articleInfo,'cateInfo'=>$cateInfo]);
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

        if($request->hasFile('article_file')){
            $post['article_file']=$this->upload('article_file');
        }
        //
        Article::where('article_id',$id)->update($post);
        return redirect('article/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $res=0;
        $id=$request->input('id');
        $ArticleInfo = Article::find($id);
        $result=$ArticleInfo->delete();
        $result==true && $res=1;
        return  $res;
    }

    //
    public function changeTitle(){
       $article_title=request()->article_title;
//       echo $article_title;die;
       $count=Article::where('article_title',$article_title)->count();
       return $count;
    }
}
