<?php  
namespace app\common;

class Tool{
    //传入设备信息数组  返回状态  
    static public function isStatus_lou($arr){
        // var_dump($arr);
        foreach ($arr[0] as $key => $value) {
            //将得到的状态加入数组
            $data[] = $value['eq_status'];
        }
        //判断状态
        if(in_array(1,$data)){
            //未巡更
            return 1;
        }elseif(in_array(3,$data)){
            //需检修
            return 3;
        }else{
            //已巡更
            return 2;
        }
    }
 }

?>