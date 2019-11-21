<?php
/*
 * 公共方法
 */

use App\Admin\Goods;

function getCateInfo($cateInfo, $parent_id=0, $level=1){
    static $info=[];
    foreach($cateInfo as $k=>$v){
        if($v['parent_id']==$parent_id){
            $v['level']=$level;
            $info[]=$v;
            getCateInfo($cateInfo,$v['cate_id'],$level+1);
        }
    }
    return $info;
}

function aa($buy_number,$goods_id){
    $goods_number=Goods::select('goods_num')->where('goods_id',$goods_id)->get();
    if($buy_number>int($goods_number)){
        return false;
    }else{
        return true;
    }
    if(empty($res)){
        redirect('index/detail')->with('msg','购买数量超过库存');
    }
}