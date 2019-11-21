

    <div class="page-content">
        <div class="row">


            <div class="col-xs-12">

                <form class="form-horizontal" role="form" method="post" action="{{url('goods/update/'.$goodsInfo->goods_id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 商品名称 </label>

                        <div class="col-sm-9">
                            <input type="text" id="form-field-1" value="{{$goodsInfo->goods_name}}"  class="col-xs-10 col-sm-5" name="goods_name" />
                        </div>
                    </div>

                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 价格 </label>

                        <div class="col-sm-9">
                            <input type="text" id="form-field-2" value="{{$goodsInfo->goods_price}}" class="col-xs-10 col-sm-5" name="goods_price" />
                        </div>
                    </div>

                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 库存 </label>

                        <div class="col-sm-9">
                            <input type="text" id="form-field-3" value="{{$goodsInfo->goods_num}}" class="col-xs-10 col-sm-5" name="goods_num" />
                        </div>
                    </div>
                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 详情 </label>

                        <div class="col-sm-9">
                            <textarea name="goods_desc" id="editor">{{$goodsInfo->goods_desc}}</textarea>
                        </div>
                    </div>

                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 图片 </label>

                        <div class="col-sm-9">
                            <input type="file" name="myfile">
                            <img src="{{$goodsInfo->goods_img}}" width="50px" height="50px">
                        </div>
                    </div>

                    <div class="space-4"></div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 相册 </label>

                        <div class="col-sm-9">
                            <input type="file" name="myfiles[]" multiple>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 新品 </label>

                        <div class="col-sm-9">
                            @if ($goodsInfo['goods_new']==1)
                                <input type="radio" value="1" name="goods_new" checked>是
                                <input type="radio" value="2" name="goods_new">否
                            @else
                                <input type="radio" value="1" name="goods_new" >是
                                <input type="radio" value="2" name="goods_new" checked>否
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 精品 </label>

                        <div class="col-sm-9">
                            @if ($goodsInfo['goods_best']==1)
                            <input type="radio" value="1" name="goods_best" checked>是
                            <input type="radio" value="2" name="goods_best">否
                            @else
                            <input type="radio" value="1" name="goods_best" >是
                            <input type="radio" value="2" name="goods_best" checked>否
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 热卖 </label>

                        <div class="col-sm-9">
                            @if ($goodsInfo['goods_hot']==1)
                            <input type="radio" value="1" name="goods_hot" checked>是
                            <input type="radio" value="2" name="goods_hot">否
                            @else
                            <input type="radio" value="1" name="goods_hot" >是
                            <input type="radio" value="2" name="goods_hot" checked>否
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 上架 </label>

                        <div class="col-sm-9">
                            @if ($goodsInfo['goods_up']==1)
                            <input type="radio" value="1" name="goods_up" checked>是
                            <input type="radio" value="2" name="goods_up">否
                            @else
                            <input type="radio" value="1" name="goods_up" >是
                            <input type="radio" value="2" name="goods_up" checked>否
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 品牌 </label>

                        <div class="col-sm-9">
                            <select name="brand_id">
                               @foreach($brandInfo as $v)

                                <option value="{{$v->brand_id}}" {{$goodsInfo['brand_id']==$v['brand_id']?'selected':''}}>{{$v->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 分类 </label>

                        <div class="col-sm-9">
                            <select name="cate_id">
                                @foreach($cateInfo as $v)
                                <option value="{{$v->cate_id}}"  {{$goodsInfo['cate_id']==$v['cate_id']?'selected':''}}> @php echo str_repeat('&nbsp;&nbsp;',$v->level*3)@endphp {{$v->cate_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit">
                                <i class="icon-ok bigger-110"></i>
                                修改
                            </button>

                            &nbsp; &nbsp; &nbsp;
                            <button class="btn" type="reset">
                                <i class="icon-undo bigger-110"></i>
                                重置
                            </button>
                        </div>
                    </div>

                    <div class="hr hr-24"></div>




                </form>
            </div><!-- /span -->
        </div><!-- /row -->

    </div><!-- /.page-content -->
</div><!-- /.main-content -->
<script>
    var ue = UE.getEditor('editor');
</script>