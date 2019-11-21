

    <div class="page-content">
        <div class="row">


            <div class="col-xs-12">

                <form class="form-horizontal" action="{{url('category/update/'.$data->cate_id)}}" role="form" method="post"  id="myform">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 分类名称 </label>

                        <div class="col-sm-9">
                            <input type="text" id="form-field-1" value="{{$data->cate_name}}" placeholder="分类名称" class="col-xs-10 col-sm-5" name="cate_name" />
                            <b style="color: red">@php echo $errors->first('brand_name'); @endphp</b>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 是否展示 </label>

                        <div class="col-sm-9">
                            @if ($data->cate_show==1)
                            <input type="radio" value="1" name="cate_show" checked>是
                            <input type="radio" value="2" name="cate_show">否
                            @else
                            <input type="radio" value="1" name="cate_show" >是
                            <input type="radio" value="2" name="cate_show" checked>否
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 是否在导航栏展示 </label>

                        <div class="col-sm-9">
                            @if ($data->cate_nav_show==1)
                            <input type="radio" value="1" name="cate_nav_show" checked>是
                            <input type="radio" value="2" name="cate_nav_show" >否
                            @else
                            <input type="radio" value="1" name="cate_nav_show" >是
                            <input type="radio" value="2" name="cate_nav_show" checked>否
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 父类 </label>

                        <div class="col-sm-9">
                            <select name="parent_id">
                                <option value="0">--请选择--</option>
                                @foreach ($cateInfo as $v)
                                    @if ($data->parent_id==$v->cate_id)
                                        <option value="{{$v->cate_id}}" selected> @php echo str_repeat('&nbsp;&nbsp;',$v->level*3)@endphp {{$v->cate_name}}</option>
                                    @else
                                        <option value="{{$v->cate_id}}">@php echo str_repeat('&nbsp;&nbsp;',$v->level*3)@endphp {{$v->cate_name}}</option>
                                    @endif
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
