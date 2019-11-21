<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/static/admin/js/jquery.js"></script>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

<form action="">
    <input type="text" name="article_title" value="{{$query['article_title']??''}}">
    <select name="cate_id">
        <option value="">--请选择--</option>
        @foreach($cateInfo as $v)
            @if(empty($query['cate_id']))
                <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
            @else
                <option value="{{$v->cate_id}}" {{$query['cate_id']==$v['cate_id?']?'selected':''}}>{{$v->cate_name}}</option>
            @endif
            @endforeach
    </select>
    <input type="submit" value="搜索">
</form>

<a href="{{url('article/create')}}">添加</a>
    <table border="1">
        <tr>
            <td>编号</td>
            <td>文章标题</td>
            <td>文章分类</td>
            <td>文章重要性</td>
            <td>是否显示</td>
            <td>文章作者</td>
            <td>作者Email</td>
            <td>关键字</td>
            <td>网页描述</td>
            <td>上传文件</td>
            <td>添加日期</td>
            <td>操作</td>
        </tr>
        @foreach($articleInfo as $v)
        <tr id="{{$v->article_id}}">
            <td>{{$v->article_id}}</td>
            <td>{{$v->article_title}}</td>
            <td>{{$v->cate_name}}</td>
            <td>{{$v->article_zy==1?'普通':'置顶'}}</td>
            <td>{{$v->article_show==1?'√':'×'}}</td>
            <td>{{$v->article_author}}</td>
            <td>{{$v->article_email}}</td>
            <td>{{$v->article_word}}</td>
            <td>{{$v->article_desc}}</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->article_file}}"width="50px" height="40px"></td>
            <td>{{date("Y-m-d H:i:s",$v->create_time)}}</td>
            <td>
                <a href="javascript:;" class="del">删除</a>
                <a href="{{url('article/edit/'.$v->article_id)}}">编辑</a>
            </td>
        </tr>
            @endforeach
    </table>
{{--{{$data->appends($query)->links()}}--}}

{{$articleInfo->appends($query)->links()}}
</body>
</html>

<script>
    $(".del").click(function(){
        var id = $(this).parents('tr').attr('id');
        var r = confirm('确定要删除么');
        if(r==true) {
            $.ajax({
                url: "{{ URL('article/delete')}}",
                type: "POST",
                data:{id:id,_token:'{{csrf_token()}}'},
                success: function(data){
                    if(data==1){
                        alert('删除成功');
                        location.href= "{{ URL('article/index/')}}";
                    } else {
                        alert('删除失败');
                    }
                }});
        }
    })

</script>