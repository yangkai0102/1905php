<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet" />



    <!-- Custom Fonts -->
	<link rel="stylesheet" href="__STATIC__/admin/css/font-awesome.min.css" />
    <script src="/static/admin/css/jquery.js"></script>

    <link type="text/css" href="/static/index/css/style1.css" rel="stylesheet" />

</head>

<body>
<div class="box">
    <ul class="minbox">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <ol class="maxbox">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ol>
</div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">laravel后台登录</h3>
                    </div>
                    <div class="panel-body">
{{--                        {{session('msg')}}--}}
                        <form role="form" method="post" action="{{url('login/store')}}">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="账号" name="admin_name"  >
                                    <b style="color: red">@php echo $errors->first('admin_name'); @endphp</b>

                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="密码" name="admin_pwd" type="password" value="">
                                    <b style="color: red">@php echo $errors->first('admin_pwd'); @endphp</b>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <input type="text"  style="width: 100px;" name="code">--}}
{{--                                    <img src="{:captcha_src()}" alt="captcha" width="200px;" id="changeImg"/>--}}
{{--                                </div>--}}

                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="登录"  class="btn btn-lg btn-success btn-block">

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
