<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/static/admin/js/jquery.js"></script>

</head>
<body>
<form action="{{url('article/update/'.$articleInfo->article_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <table border="1">
        <tr>
            <td>文章标题</td>
            <td><input type="text" name="article_title" value="{{$articleInfo->article_title}}" id="article_title">
                <span></span>

            </td>
        </tr>
        <tr>
            <td>文章分类</td>
            <td>
                <select name="cate_id">
                    @foreach ($cateInfo as $v)
                        <option value="{{$v->cate_id}}" {{$v['cate_id']==$articleInfo['cate_id']?'selected':''}}>{{$v->cate_name}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>文章重要性</td>
            <td>
                <input type="radio" name="article_zy" value="1" {{$articleInfo['article_zy']==1?'checked':''}}>普通
                <input type="radio" name="article_zy" value="2" {{$articleInfo['article_zy']==2?'checked':''}}>置顶
            </td>
        </tr>
        <tr>
            <td>是否显示</td>
            <td>
                <input type="radio" name="article_show" value="1" {{$articleInfo['article_show']==1?'checked':''}}>显示
                <input type="radio" name="article_show" value="2" {{$articleInfo['article_show']==2?'checked':''}}>不显示
            </td>
        </tr>
        <tr>
            <td>文章作者</td>
            <td><input type="text" name="article_author" value="{{$articleInfo->article_author}}"></td>
        </tr>
        <tr>
            <td>作者Email</td>
            <td><input type="text" name="article_email" value="{{$articleInfo->article_email}}"></td>
        </tr>
        <tr>
            <td>关键字</td>
            <td><input type="text" name="article_word" value="{{$articleInfo->article_word}}"></td>
        </tr>
        <tr>
            <td>网页描述</td>
            <td><textarea name="article_desc">{{$articleInfo->article_desc}}</textarea></td>
        </tr>
        <tr>
            <td>上传文件</td>
            <td>
                <img src="{{env('UPLOAD_URL')}}{{$articleInfo->article_file}}"  width="50px" height="40px"  alt="">
                <input type="file" name="article_file">
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="修改" id="form"></td>
            <td></td>
        </tr>
    </table>
</form>
</body>
</html>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('blur','#article_title',function(){
        var _this=$(this);
        var article_title=_this.val();
        var reg=/^[\u4e00-\u9fa5\w]{1,}$/;
        if(!reg.test(article_title)){
            alert("标题不符合规范");
            return;
        }

        $.ajax({
            method:'post',
            url:"{{url('article/changeTitle')}}",
            data:{article_title:article_title}
        }).done(function (res) {
            if(res>0){
                $("#article_title").next('span').text('标题已存在');
            }
        })
    })

    $(document).on('click','#form',function(){
        var article_title=$("#article_title").val();
        var reg=/^[\u4e00-\u9fa5\w]{2,12}$/;
        if(!reg.test(article_title)){
            alert("标题不符合规范");
            return false;
        }
        var flag=true;
        $.ajax({
            method:'post',
            url:"{{url('article/changeTitle')}}",
            async:false,
            data:{article_title:article_title}
        }).done(function (res) {
            if(res>0){
                $("#article_title").next('span').text('标题已存在');
                flag=false;
            }
        });
        if(!flag){
            return false;
        }
    })
</script>