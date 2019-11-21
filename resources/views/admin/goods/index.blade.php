
<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">

    <div class="page-content">
        <div class="row">


            <div class="col-xs-12">



                <div class="table-responsive">
                    <form action="" method="get">
                        <input type="text" placeholder="商品名称" name="goods_name" style="width: 100px;">
                        <input type="text" placeholder="最低价格" name="min_price" style="width: 100px;"  value="{{$query['min_price']??''}}">
                        -
                        <input type="text" placeholder="最高价格" name="max_price" style="width: 100px;"  value="{{$query['max_price']??''}}">
                        品牌:<select name="brand_id">
                            <option value="">--请选择--</option>
                            @foreach($brandInfo as $v)
                                @if(empty($query['brand_id']))
                                    <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                                @else
                                    <option value="{{$v->brand_id}}" {{$query['brand_id']==$v['brand_id']?'selected':''}}>{{$v->brand_name}}</option>
                                @endif
                            @endforeach
                        </select>

                        分类:<select name="cate_id">
                            <option value="">--请选择--</option>
                            @foreach($cateInfo as $v)
                                @if(empty($query['cate_id']))
                                <option value="{{$v->cate_id}}">@php echo str_repeat('&nbsp;&nbsp;',$v['level']*3)@endphp {{$v->cate_name}}</option>
                                @else
                                    <option value="{{$v->cate_id}}" {{$query['cate_id']==$v['cate_id']?'selected':''}}>{:str_repeat('&nbsp;&nbsp;',$v['level']*3)}{{$v->cate_name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <input type="submit" value="搜索">

                    </form>
                    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>商品id</th>
                                <th>商品名称</th>
                                <th>价格</th>
                                <th>库存</th>
                                <th>图片</th>
                                <th>相册</th>
                                <th>新品</th>
                                <th>精品</th>
                                <th>热卖</th>
                                <th>上架</th>
                                <th>品牌</th>
                                <th>分类</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($goodsInfo as $v)
                            <tr goods_id="{{$v->goods_id}}">
                                <td>{{$v->goods_id}}</td>
                                <td>{{$v->goods_name}}</td>
                                <td>{{$v->goods_price}}</td>
                                <td>{{$v->goods_num}}</td>
                                <td><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="50px" height="50px"></td>
                                <td>

                                </td>
                                <td>{{$v->goods_new==1?'√':'×'}}</td>
                                <td>{{$v->goods_best==1?'√':'×'}}</td>
                                <td>{{$v->goods_hot==1?'√':'×'}}</td>
                                <td>{{$v->goods_up==1?'√':'×'}}</td>
                                <td>{{$v->brand_name}}</td>
                                <td>{{$v->cate_name}}</td>
                                <td>
                                    <a href="{{url('goods/edit/'.$v->goods_id)}}">编辑</a>
                                    <a href="{{url('goods/delete/'.$v->goods_id)}}">删除</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$goodsInfo->appends($query)->links()}}

                </div><!-- /.table-responsive -->
            </div><!-- /span -->
        </div><!-- /row -->

    </div><!-- /.page-content -->
</div><!-- /.main-content -->


