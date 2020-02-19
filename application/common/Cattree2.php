<?php  
namespace app\common;

class Cattree2{

    static public function getCates($cates=[],$id=0){

    $arr = [];

    foreach ($cates as $key => $v) {
    if($v['pid'] == $id){

    $v['sub'] = self::getCates($cates,$v['id']);

    $arr[] = $v;

    }

    }

    return $arr;

    }
 }

?>