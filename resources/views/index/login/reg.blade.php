@extends('layouts.shop')
@section('title','全国最大珠宝商-注册')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form  class="reg-login" action="{{url('regDo')}}" method="post">
         @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList">
           <input type="text" class="name" placeholder="输入手机号码或者邮箱号" name="email" />
       </div>
       <div class="lrList2">
           <input type="text" placeholder="输入短信验证码" name="code"/>
           <a id="checkCode">获取验证码</a>
       </div>
       <div class="lrList"><input type="password" name="pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="password" name="pwd2" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="index.html">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="prolist.html">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="car.html">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl>
       <a href="user.html">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
     @endsection
<script src="/static/admin/js/jquery.js"></script>
<script>
    $(document).ready(function () {

        $(document).on('click','#checkCode',function () {

            var email=$("div[class='lrList']").children().val();
            // console.log(email);
            var reg=/^\w+@\w+\.com$/;
            if(email==''){
                alert('邮箱不能为空');
                return false;
            }else if(!reg.test(email)){
                alert('邮箱格式有误');
                return false;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{url('send')}}",
                method:'post',
                data:{email:email},
                dataType:'json'
            }).done(function (res) {
                // console.log(res);
                if(res.code==1){
                    alert(res.font)
                }else{
                    alert(res.font)
                }
            });
            return false;
        });
    });
</script>