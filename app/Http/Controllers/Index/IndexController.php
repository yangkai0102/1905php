<?php

namespace App\Http\Controllers\Index;

use App\Admin\Cate;
use App\Http\Controllers\Controller;
use App\Index\Cart;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use App\Admin\Goods;
use App\Admin\Category;
class IndexController extends Controller
{

    public function index(){

        $cateInfo=cache('cateInfo');
//        dump($cateInfo);
        if(!$cateInfo){

            $cateInfo=Category::where('cate_nav_show',1)->get();
//        dd($cateInfo);
            cache(['cateInfo'=>$cateInfo],5);
        }

        $goodsInfo=cache('goodsInfo');
        if(!$goodsInfo){

            $goodsInfo=Goods::select('goods_id','goods_name','goods_price','goods_img')
                ->get();
            cache(['goodsInfo'=>$goodsInfo],5);
        }


        return view('index/index/index',['cateInfo'=>$cateInfo,'goodsInfo'=>$goodsInfo]);
    }

    public function detail($id){
        $goodsInfo=cache('goodsInfo');
        if(!$goodsInfo) {
            $goodsInfo = Goods::find($id);
            cache(['goodsInfo' => $goodsInfo], 5);
        }

        $goodsInfo['goods_imgs']=explode('|',$goodsInfo['goods_imgs']);
//        dd($goodsInfo);
        return view('index/index/detail',['goodsInfo'=>$goodsInfo]);
    }

    public function addCart(){
        $cartInfo=cache('cartInfo');
        if(!$cartInfo){
            $buy_number=request()->buy_number;
            $goods_id=request()->goods_id;
            $goods_price=request()->goods_price;
//        echo $goods_id;
            $user=session('index');
//        dd($user);

            if(empty($user)){
                return redirect('login');
            }else{
                $user_id=$user['user_id'];
                $where=[
                    ['goods_id','=',$goods_id],
                    ['user_id','=',$user_id],
                    ['is_del','=',1]
                ];
                $cartInfo=Cart::where($where)->first();
                cache(['cartInfo'=>$cartInfo],10);
        }
//            dd($cartInfo);
            if(empty($cartInfo)){
                $arr=['goods_id'=>$goods_id,'user_id'=>$user_id,'buy_number'=>$buy_number,'add_time'=>time(),'add_price'=>$goods_price];
                $info=Cart::create($arr);
                if($info->cart_id){
                    return redirect('order/cartList');
                }
            }else{
                $buy_number=$buy_number+$cartInfo['buy_number'];
                Cart::where($where)->update(['buy_number'=>$buy_number,'add_time'=>time()]);
                return redirect('order/cartList');
            }
        }
    }

    public function cartList(){
        $cartInfo=cache('cartInfo');
        if(!$cartInfo) {
            $user = session('index');
            $user_id = $user['user_id'];
            $where = [
                ['user_id', '=', $user_id],
                ['is_del', '=', 1]
            ];
            $cartInfo = Cart::join("goods", "goods.goods_id", "=", "cart.goods_id")
                ->where($where)
                ->orderBy('add_time', 'desc')
                ->get();
//        dd($cartInfo);
            cache(['cartInfo' => $cartInfo], 10);
        }

        return view('index/order/cartList',['cartInfo'=>$cartInfo]);
    }

}
