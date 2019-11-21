@extends('layouts.shop')
@section('title','全国最大珠宝商')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
         @foreach($goodsInfo['goods_imgs'] as $v)
      <img src="{{env('UPLOAD_URL')}}{{$v}}" />
      @endforeach
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$goodsInfo->goods_price}}</strong></th>
       <td>
           <input type="hidden" value="{{$goodsInfo->goods_num}}" id="goods_num">

           <button class="decrease" id="less">-</button>
           <input type="text" value="1" id="buy_number">{{session('msg')}}
           <button class="decrease" id="add">+</button>

       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$goodsInfo->goods_name}}</strong>
        <p class="hui">{{$goodsInfo->goods_desc}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="/static/index/images/image4.jpg" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="javascript:;" id="addCart">加入购物车</a></td>
      </tr>
     </table>
@endsection
<script src="/static/admin/js/jquery.js"></script>

<script>

    $(document).ready(function(){
        $(document).on('click','#add',function () {
            var goods_num=parseInt($("#goods_num").val());//获取库存
            var buy_number=parseInt($("#buy_number").val());//获取文本框的值

            // buy_number=parseInt(buy_number);
            if(buy_number>=goods_num){
                $("#buy_number").val(goods_num);
            }else{
                var buy_number=buy_number+1;
                $("#buy_number").val(buy_number);
            }

        });

        //点击减号
        $(document).on('click','#less',function () {
            var buy_number=parseInt($("#buy_number").val());//获取文本框的值
            if(buy_number<=1){
                $("#buy_number").val(1);
            }else{
                var buy_number=buy_number-1;
                $("#buy_number").val(buy_number);
            }
        })

        //失去焦点
        $(document).on('blur','#buy_number',function () {
            var goods_num=parseInt($("#goods_num").val());//获取库存
            var buy_number=parseInt($("#buy_number").val());//获取文本框的值

            //检测是否是数字
            var reg= /^\d+$/;
            if(!reg.test(buy_number)||parseInt(buy_number)<=0){
                $("#buy_number").val(1);
            }else if(parseInt(buy_number)>=goods_num){
                $("#buy_number").val(goods_num);
            }else{
                buy_number=parseInt(buy_number);
                $("#buy_number").val(buy_number);
            }
        })

        //加入购物车
        $(document).on("click","#addCart",function () {
            var buy_number=$("#buy_number").val();
            var goods_id="{{$goodsInfo->goods_id}}";
            var goods_price="{{$goodsInfo->goods_price}}";
            // console.log(goods_id)
            // return false;
            location.href="{{url('index/addCart')}}?goods_id="+goods_id+"&buy_number="+buy_number+"&goods_price="+goods_price;
        })
    });


</script>