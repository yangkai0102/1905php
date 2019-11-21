<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/static/admin/js/jquery.js"></script>
    <title>Document</title>
</head>
<body>
<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <table  id="sample-table-1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>

                    <th>分类编号</th>
                    <th>分类名称</th>
                    <th>是否展示</th>
                    <th>是否在导航栏展示</th>
                    <th>编辑</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cateInfo as $v)
                    <tr  style="display: none" parent_id="{{$v->parent_id}}" cate_id="{{$v->cate_id}}">
                        <td>
                            @php echo str_repeat('&nbsp;&nbsp;',$v['level']*3);@endphp
                            <a href="javascript:;" class="flag">+</a>
                            {{$v->cate_id}}
                        </td>
                        <td feil="cate_name">
                            @php echo str_repeat('&nbsp;&nbsp;',$v->level*3)@endphp
                            <span class="span_text">{{$v->cate_name}}</span>
                        </td>
                        <td>@php echo $v->cate_show==1 ? '展示' : '不展示' @endphp</td>
                        <td>@php echo $v->cate_nav_show==1 ? '展示' : '不展示' @endphp</td>
                        <td>
                            <a href="{{url('category/edit/'.$v->cate_id)}}">编辑</a>
                            <a href="{{url('category/delete/'.$v->cate_id)}}">删除</a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div><!-- /.table-responsive -->
    </div><!-- /span -->
</div><!-- /row -->

</body>
</html>

<script>
    //页面一加载
    $("tr[parent_id='0']").show();

    //点击符号
    $(".flag").click(function(){
        var _this=$(this);//当前点击的超链接
        var cate_id=_this.parents("tr").attr('cate_id');//获取当前点击的分类id

        var flag=_this.text();//获取当前符号
        var _child=$("tr[parent_id='"+cate_id+"']");
        if(flag=='+'){
            if( _child.length>0){
                _child.show();//给当前分类下子类做显示
                _this.text('-');
            }
        }else{
            _child.hide();//给当前分类下子类做隐藏
            _this.text('+');
        }
    });
    </script>