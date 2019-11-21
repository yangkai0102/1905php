<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
</head>
<body>
<center><h2>编辑管理员信息</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="form-horizontal" role="form" action="{{url('admin/update/'.$data->admin_id)}}" method="post">
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <input type="text" name="admin_name" value="{{$data->admin_name}}" class="form-control" id="firstname"
                >
                <b style="color: red">@php echo $errors->first('brand_name'); @endphp</b>
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" name="admin_pwd" value="{{$data->admin_pwd}}" class="form-control" id="lastname"
                >
                <b style="color: red">@php echo $errors->first('brand_url'); @endphp</b>

            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
                <input type="text" name="admin_email" value="{{$data->admin_email}}" class="form-control" id="lastname"
                >
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">修改</button>
            </div>
        </div>
    </form>
</center>
</body>
</html>