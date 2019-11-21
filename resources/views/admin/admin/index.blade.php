<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
</head>
<body>

<h2>管理员列表</h2>

<form action="">
    <input type="text" name="word" value="{{$query['word']??''}}" placeholder="请输入管理员关键字">
    <button>搜索</button>
</form>

<a href="{{url('/admin/create')}}">添加</a>
<table class="table">

    <thead>
    <tr>
        <th>管理员id</th>
        <th>管理员账号</th>
        <th>管理员密码</th>
        <th>管理员邮箱</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach ($data as $v)
            <tr @if ($i%2==0) class="warning" @else class="danger" @endif>
                <td>{{$v->admin_id}}</td>
                <td>{{$v->admin_name}}</td>
                <td>{{$v->admin_pwd}}</td>
                <td>{{$v->admin_email}}</td>
                <td>
                    <a href="{{url('/admin/edit/'.$v->admin_id)}}">编辑</a>
                    <a href="{{url('/admin/delete/'.$v->admin_id)}}">删除</a>
                </td>
            </tr>
            @php $i++ @endphp
        @endforeach
    </tbody>
</table>

{{$data->appends($query)->links()}}
</body>
</html>