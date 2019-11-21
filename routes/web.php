<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//闭包路由
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/hello',function(){
//    echo 123;
//});
////路由视图
//Route::view('/test','hh');

//post视图
//Route::post('/dofrom',function (){
//    $post=request()->post();
//    dd($post);
//});
//
//Route::get('/reg','RegController@index');
//Route::post('/dofrom','RegController@dofrom');
//
//Route::redirect('/reg','/hello');

//Route::get('/goods/{goods_id}',function ($goods_id){
//   echo $goods_id;
//});

//Route::get('/goods/{goods_id}','RegController@goods');

//必填
//Route::get('/goods/{goods_id}/{goods_name}',function ($goods_id,$goods_name){
//   echo $goods_id;
//   echo $goods_name;
//})->where(['goods_id'=>'\d+','goods_name'=>'\w+']);

//可填
//Route::get('/show/{goods_id?}',function ($goods_id='杨凯'){
//    echo $goods_id;
//});

//cookie
//Route::get('/setcookie',function(){
    //队列设置
//    Cookie::queue(Cookie::make('username','杨凯',2));
    //获取
//    $name =request()->cookie('name');

//    $name=Illuminate\Support\Facades\Cookie::get('username');
//    echo $name;

//    return response('欢迎来到laravel学院')->cookie('name','杨凯',2);
//});


Route::get('/',function(){
    if($_SERVER['HTTP_HOST']=='admin.yk.cn'){
        return redirect('/login/create');
    }else{
        return redirect('/index');
    }
});
Route::prefix('/index')->group(function () {
    Route::get('/', 'Index\IndexController@index')->middleware('checkIndexlogin');
    Route::get('/detail/{id}', 'Index\IndexController@detail');

});
Route::get('/index/addCart', 'Index\IndexController@addCart');
Route::get('/order/cartList', 'Index\IndexController@cartList');
Route::post('/cart/getCount', 'Index\CartController@getCount');
Route::post('/cart/changeNum', 'Index\CartController@changeNum');
Route::post('/cart/getTotal', 'Index\CartController@getTotal');
Route::post('/cart/del', 'Index\CartController@del');
Route::get('/cart/pay', 'Index\CartController@pay');
Route::get('/cart/submitOrder', 'Index\CartController@submitOrder');
Route::get('/cart/success', 'Index\CartController@success');
Route::get('/cart/payDo/{order_id}', 'Index\CartController@payDo');
Route::get('/cart/return_url', 'Index\CartController@return_url');


Route::get('/admin/student', 'Admin\AdminController@student');
Route::view('/phtos','phtos');




    //登录  注册
    Route::view('/login','index.login.login');
    Route::view('/reg','index.login.reg');
    Route::post('/send','Index\LoginController@send');
    Route::post('/regDo','Index\LoginController@regDo');
    Route::post('/loginDo','Index\LoginController@loginDo');

Route::get('/test','Index\LoginController@test');

//登录
Route::prefix('/login')->group(function () {
    Route::get('create', 'Admin\LoginController@create');
    Route::post('store', 'Admin\LoginController@store');
    Route::post('create', 'Admin\LoginController@create');
});

//Route::domain('admin.yk.cn/')->group(function() {
//    Route::view('/','admin.login.create');
    //品牌
    Route::prefix('/brand')->group(function () {
        Route::get('create', 'Admin\BrandController@create');
        Route::post('store', 'Admin\BrandController@store');
        Route::get('index', 'Admin\BrandController@index');
        Route::get('delete/{id}', 'Admin\BrandController@destroy');
        Route::get('edit/{id}', 'Admin\BrandController@edit');
        Route::post('update/{id}', 'Admin\BrandController@update');
    });

    //管理员
    Route::prefix('/admin')->middleware('checklogin')->group(function () {
        Route::get('create', 'Admin\AdminController@create');
        Route::post('store', 'Admin\AdminController@store');
        Route::get('index', 'Admin\AdminController@index');
        Route::get('delete/{id}', 'Admin\AdminController@destroy');
        Route::get('edit/{id}', 'Admin\AdminController@edit');
        Route::post('update/{id}', 'Admin\AdminController@update');
    });

    //分类
    Route::prefix('/category')->middleware('checklogin')->group(function () {
        Route::get('create', 'Admin\CategoryController@create');
        Route::post('store', 'Admin\CategoryController@store');
        Route::get('index', 'Admin\CategoryController@index');
        Route::get('delete/{id}', 'Admin\CategoryController@destroy');
        Route::get('edit/{id}', 'Admin\CategoryController@edit');
        Route::post('update/{id}', 'Admin\CategoryController@update');

    });

    //商品
    Route::prefix('/goods')->middleware('checklogin')->group(function () {
        Route::get('create', 'Admin\GoodsController@create');
        Route::post('store', 'Admin\GoodsController@store');
        Route::get('index', 'Admin\GoodsController@index');
        Route::get('delete/{id}', 'Admin\GoodsController@destroy');
        Route::get('edit/{id}', 'Admin\GoodsController@edit');
        Route::post('update/{id}', 'Admin\GoodsController@update');

    });


//});

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');

//文章
//Route::prefix('/article')->middleware('checklogin')->group(function(){
//    Route::get('create','Admin\ArticleController@create');
//    Route::post('store','Admin\ArticleController@store');
//    Route::get('index','Admin\ArticleController@index');
//    Route::post('delete','Admin\ArticleController@delete');
//    Route::get('edit/{id}','Admin\ArticleController@edit');
//    Route::post('update/{id}','Admin\ArticleController@update');
//    Route::post('changeTitle','Admin\ArticleController@changeTitle');
//
//});

