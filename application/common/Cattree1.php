<?php  
namespace app\common;
class Cattree1

{

    public function cateSort($data,$pid=0,$level=0) {

    static $arr = array();

        foreach($data as $k => $v) {

            if($v['pid'] == $pid) {

                $arr[$k] = $v;

                $arr[$k]['level'] = $level + 1;

                $this->cateSort($data,$v['id'],$level+1);

            }

        }

        return $arr;

    }

}


?>