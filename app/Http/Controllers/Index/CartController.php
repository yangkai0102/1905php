<?php

namespace App\Http\Controllers\index;

use AlipayTradeService;
use AlipayTradeWapPayContentBuilder;
use App\Http\Controllers\Controller;
use App\Index\Order;
use App\Index\OrderGoods;
use Illuminate\Http\Request;
use App\Index\Cart;
use DB;
class CartController extends Controller
{
    //获取总价
    public function getCount(){
        $goodsInfo=cache('goodsInfo');
        if(!$goodsInfo) {
            $goods_id = request()->goods_id;
            $goods_id = explode(',', $goods_id);
//        print_r($goods_id);die;
//        echo $goods_id;die;
            $user = session('index');
            $user_id = $user['user_id'];

//        print_r($where);die;
            $goodsInfo = Cart::join('goods', 'cart.goods_id', '=', 'goods.goods_id')
                ->whereIn('goods.goods_id', $goods_id)
                ->where('user_id', $user_id)
                ->get();
            cache(['goodsInfo' => $goodsInfo], 5);
        }
            $money=0;
        foreach($goodsInfo as $k=>$v){
            $money+=$v['goods_price']*$v['buy_number'];
        }
        return $money;
    }

    //更改购买数量
    public function changeNum(){
        $buy_number=request()->buy_number;
        $goods_id=request()->goods_id;
        $user=session('index');
        $user_id=$user['user_id'];
        $where=[
            ['user_id','=',$user_id],
            ['goods_id','=',$goods_id],
            ['is_del','=',1]
        ];
        $res=Cart::where($where)->update(['buy_number'=>$buy_number]);
//        echo $res;die;
        if($res){
            echo json_encode(['font'=>'','code'=>1]);
        }else{
            echo json_encode(['font'=>'更改购买数量失败','code'=>2]);die;
        }
    }

    //获取小计
    public function getTotal(){
        $goodsInfo=cache('goodsInfo');
        if(!$goodsInfo) {
            $goods_id = request()->goods_id;
//        echo $goods_id;
            $user = session('index');
            $user_id = $user['user_id'];
            $where = [
                ['user_id', '=', $user_id],
                ['goods.goods_id', '=', $goods_id],
                ['is_del', '=', 1]
            ];
            $goodsInfo = Cart::join('goods', 'cart.goods_id', '=', 'goods.goods_id')
                ->select('goods_price', 'buy_number')
                ->where($where)
                ->first();
            cache(['goodsInfo'=>$goodsInfo],10);
        }
        $total=$goodsInfo['goods_price']*$goodsInfo['buy_number'];
        echo $total;
    }

    //删除
    public function del(){
        $goods_id=request()->goods_id;

//        echo $goods_id;die;
        $res=Cart::where('goods_id',$goods_id)->update(['is_del'=>2]);
        if($res){
            echo json_encode(['font'=>'','code'=>1]);
        }else{
            echo json_encode(['font'=>'删除失败','code'=>2]);die;
        }
    }

    //
    public function pay(){
        $goodsInfo=cache('goodsInfo');
        if(!$goodsInfo) {
            $goods_id = request()->goods_id;
//        echo $goods_id;
            $goods_id = explode(',', $goods_id);
//        print_r($goods_id);die;
            $goodsInfo = Cart::join('goods', 'cart.goods_id', '=', 'goods.goods_id')
                ->whereIn('cart.goods_id', $goods_id)
                ->where('is_del', 1)
                ->get();
//        dd($goodsInfo);
            cache(['goodsInfo' => $goodsInfo], 10);
        }
        $count=0;
        foreach($goodsInfo as $k=>$v){
            $count+=$v['buy_number']*$v['goods_price'];
        }
        return view('index/order/pay',['goodsInfo'=>$goodsInfo,'count'=>$count]);
    }

    function submitOrder(){
        $goodsInfo=cache('goodsInfo');
        if(!$goodsInfo) {
            $goods_id = request()->goods_id;
            $goods_id = explode(',', $goods_id);
            $pay_type = request()->pay_type;

            $user = session('index');
            $user_id = $user['user_id'];
            $where = [
                ['user_id', '=', $user_id],
                ['is_del', '=', 1]
            ];
            $goodsInfo = Cart::join('goods', 'goods.goods_id', '=', 'cart.goods_id')
                ->whereIn('cart.goods_id', $goods_id)
                ->where($where)
                ->select('goods.goods_id', 'goods_name', 'goods_img', 'goods_price', 'buy_number')
                ->get();
//            dd($goodsInfo);'
            cache(['goodsInfo'=>$goodsInfo],10);
        }
            $order_amount=0;
            foreach($goodsInfo as $v){
                $order_amount+=$v['goods_price']*$v['buy_number'];
            }
//            echo $order_amount;die;
        $orderInfo['order_number']=time().rand(100000,999999);
        $orderInfo['user_id']=$user_id;
        $orderInfo['order_amount']=$order_amount;
        $orderInfo['pay_type']=$pay_type;
        $orderInfo['create_time']=time();
        $order_id=Order::insertGetId($orderInfo);
//        print_r($order_id);die;
        if(empty($order_id)){
            echo "订单表数据添加失败";die;
        }

        foreach($goodsInfo as $k=>$v){
            $goodsInfo[$k]['user_id']=$user_id;
            $goodsInfo[$k]['order_id']=$order_id;
        }
        $goodsInfo=$goodsInfo->toArray();
        $res=DB::table('order_goods')->insert($goodsInfo);
//        dd($res);
        if(empty($res)){
            echo "订单商品表添加失败";die;
        }

        $res=Cart::whereIn('goods_id',$goods_id)->where($where)->update(['is_del'=>2]);
        if(empty($res)){
            echo '清除购物车数据失败';die;
        }

        echo "<script>location.href='".url('cart/success')."?order_id=$order_id';</script>";
    }

    function success(){
        $orderInfo=cache('orderInfo');
        if(!$orderInfo) {
            $order_id = request()->order_id;
//        echo $order_id;
            $user = session('index');
            $user_id = $user['user_id'];
            $where = [
                ['order_id', '=', $order_id],
                ['user_id', '=', $user_id]
            ];
            $orderInfo = Order::where($where)->first();
            cache(['orderInfo'=>$orderInfo],10);
        }
        return view('index/order/success',['orderInfo'=>$orderInfo]);
    }

    function payDo($order_id){

        $orderInfo=cache('orderInfo');
        if(!$orderInfo) {
            require_once app_path() . '/libs/alipay/wappay/service/AlipayTradeService.php';
            require_once app_path() . '/libs/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php';
            $config = config('alipay');
//            dd($config);
//        if (!empty($_POST['WIDout_trade_no'])&& trim($_POST['WIDout_trade_no'])!=""){
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $orderInfo = Order::join('order_goods', 'order.order_id', '=', 'order_goods.order_id')
                ->where('order.order_id', $order_id)
                ->first();
            cache(['orderInfo'=>$orderInfo],10);
        }
//        dd($orderInfo);
        $out_trade_no = $orderInfo->order_number;

            //订单名称，必填
            $subject = $orderInfo->goods_name;

            //付款金额，必填
            $total_amount = $orderInfo->order_amount;

            //商品描述，可空
//            $body = $_POST['WIDbody'];

            //超时时间
            $timeout_express="1m";

            $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
//            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setTimeExpress($timeout_express);

            $payResponse = new AlipayTradeService($config);
            $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

            return ;
        }
//    }

    public function return_url(){
        $config=config('alipay');
        require_once app_path().'/libs/alipay/wappay/service/AlipayTradeService.php';



        $arr=$_GET;
        $alipaySevice = new AlipayTradeService($config);
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码

            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号

            $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

            //支付宝交易号

            $trade_no = htmlspecialchars($_GET['trade_no']);

            echo "验证成功<br />外部订单号：".$out_trade_no;

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            echo "验证失败";
        }
    }
}

