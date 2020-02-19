<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\DB;
use app\common\Cattree2;
class FloorController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //接收传入的参数
        //楼名称
        $f_name = isset($_GET['f_name']) ? $_GET['f_name'] : '';
        //楼层数量
        $f_num = isset($_GET['f_num']) ? $_GET['f_num'] : '';
        //组装添加条件
        $data = ['f_name'=> $f_name, 'pid'=> 0];
        //添加楼信息
        $res = DB::table('data_floor')->insert($data);
        //判断
        if($res){
            //获取添加楼id
            $last_id = Db::name('data_floor')->getLastInsID();
            //循环添加楼层
            for($i=1;$i<=$f_num;$i++){
                //组装添加数据
                $data1 = ['f_name'=> $i.'层', 'pid'=> $last_id];
                //添加层
                $res1 = DB::table('data_floor')->insert($data1);
            }
            //成功
            return json_encode(['status'=> '成功', 'code'=> 200]);
        }else{
            //失败
            return json_encode(['status'=>'层添加失败', 'code'=> 400]);
        }
        //失败
        return json_encode(['status'=>'楼名称添加失败','code'=> 400]);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }

    /**
     * 查询所有楼信息
     *
     * @return \think\Response
     */
    public function floor_list()
    {
        //查询楼信息
        $data = DB::table('data_floor')->where(['pid'=> 0])->select();
        //判断
        if(empty($data)){
            //楼信息为空返回null
            return null;
        }
        //返回结果
        return json_encode($data);
    }

    /**
     * 查询楼对应层信息
     *param $id 楼id
     * @return \think\Response
     */
    public function floor_layer_list($id)
    {
        //接收f_id
        $f_id = $id;
        //查询层信息
        $data = DB::table('data_floor')->where(['pid'=> $f_id])->select();
        //判断
        if(empty($data)){
            //层信息为空返回null
            return null;
        }
        //返回结果
        return json_encode($data);
    }

    /**
     * 查询楼对应层信息和巡更情况
     *param $id 楼id
     * @return \think\Response
     */
    public function YD_floor_layer_list($id)
    {
        //接收f_id
        $f_id = $id;
        //查询层信息
        $data = DB::table('data_floor')->where(['pid'=> $f_id])->select();
        //判断
        if(empty($data)){
            //层信息为空返回null
            return null;
        }
        var_dump($data);
        //返回结果
        return json_encode($data);
    }

    /**
     * 添加室信息
     *
     * @return \think\Response
     */
    public function room_save()
    {
        //接收传入的参数
        //室名称
        $f_name = isset($_GET['f_name']) ? $_GET['f_name'] : '';
        //父级id
        $pid = isset($_GET['pid']) ? $_GET['pid'] : '';
        //组装添加数据
        $data = ['f_name'=> $f_name, 'pid'=> $pid];
        //添加室
        $res = DB::table('data_floor')->insert($data);
        //判断
        if($res){
            //成功
            return json_encode(['status'=> '成功', 'code'=> 200]);
        }        
        //失败
        return json_encode(['status'=> '添加室信息失败', 'code'=> 400]);
    }

    /**
     * 查询楼层室信息  返回室信息
     * @return \think\Response
     */
    public function floor_room_list()
    {
        //查询楼层室信息
        $data = DB::table('data_floor')->select();
        //调用类来处理数据  处理完格式为楼里面包含层，层里面包含教室
        $data = Cattree2::getCates($data);
        //判断
        if(empty($data)){
            //结果为空返回null
            return null;
        }
        //返回结果
        return json_encode($data);

    }

    /**
     * 查询楼层室信息 
     * @return \think\Response
     */
    public function YD_floor_room_list()
    {
        //查询楼层室信息
        $data = DB::table('data_floor')->select();
        //调用类来处理数据  处理完格式为楼里面包含层，层里面包含教室
        $data = Cattree2::getCates($data);
        //判断
        if(empty($data)){
            //结果为空返回null
            return null;
        }
        //返回结果
        var_dump($data);
        return json_encode($data);

    }

    /**
     * 查询室对应设备信息 
     * @return \think\Response
     */
    public function YD_room_equipment()
    {
        //查询室内设备信息 拼接楼层室id，等于设备表字段eq_useraddress
        //接收参数(楼层室id)
        $ids = isset($_GET['ids']) ? $_GET['ids'] : '';
        //查询数据库
        $data = DB::table('data_equipment')->where('eq_useaddress',$ids)->where('eq_status',1)->select();
        // var_dump($data);die;
        //判断
        if(empty($data)){
            //结果为空返回null
            return null;
        }
        //返回结果
        var_dump($data);
        return json_encode($data);

    }

    /**
     * 查询未巡更点下所有未巡更侧层信息
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function YD_ceng_list()
    {
        //接收楼id
        $lou_id = $_GET['lou_id'];
        //用楼id查询对应未巡更层信息
        $data = DB::table('data_floor')->where('pid',$lou_id)->select();
        //获取层id 拼接楼id
        $res = [];
        foreach ($data as $key => $value) {
            $ids = $lou_id.','.$value['id'];
            //统计所有层下未巡更的设备信息 
            $res = DB::table('data_equipment')->where('eq_useaddress','like',$ids.'%')->where('eq_status',1)->select();
            //判断是否为空
            if(!empty($res)){
                foreach ($res as $k => $v) {
                    $r[] = $v['eq_status'];
                    //判断状态
                    if(in_array(1, $r)){
                        //未巡更 
                        $s[] = $ids;
                    }else{
                        $s[] = [];
                    }
                }
            }

        }
        
            //循环获取到未巡更设备地点
            foreach ($s as $k1 => $v1) {
                //用,分割
                $address = explode(',', $v1);
                //查询对应的楼层室
                $arr = [];
                foreach ($address as $k => $v) {
                    $arr[] = DB::table('data_floor')->where('id',$v)->value('f_name');
                }
                //将数组转为字符串
                $v1 = explode(',', $v1);
                //获取id
                $v1 = $v1[1];
                $d[$v1] = implode('',$arr);
            }
            //判断
            if(empty($d)){
                //结果为空返回null
                return null;
            }
            //返回未巡更的层
            var_dump($d);
            return json_encode($d);

    }

    /**
     * 查询未巡更层下所有未巡更室信息
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function YD_shi_list()
    {
        //接收层id
        $ceng_id = $_GET['ceng_id'];
        //用层id获取楼id
        $data = DB::table('data_floor')->where('id',$ceng_id)->find();
        $pid = $data['pid'];
        //用层pid查询楼id
        $lou = DB::table('data_floor')->where('id',$pid)->find();
        $lou_id = $lou['id'];
        //用层id查询对应未巡更室信息
        $data = DB::table('data_floor')->where('pid',$ceng_id)->select();
        foreach ($data as $key => $value) {
                $ids = $lou_id.','.$ceng_id.','.$value['id'];
                //统计所有室下未巡更的设备信息  放入数组
                $res = DB::table('data_equipment')->where('eq_useaddress','like',$ids.'%')->where('eq_status',1)->select();

                //判断是否为空
                if(!empty($res)){
                    foreach ($res as $k => $v) {
                        $r[] = $v['eq_status'];
                        //判断状态
                        if(in_array(1, $r)){
                            //未巡更 
                            $s[] = $ids;
                        }else{
                            $s[] = [];
                        }
                    }
                }
            }

            //循环获取到未巡更设备地点
            foreach ($s as $k1 => $v1) {
                //用,分割
                $address = explode(',', $v1);
                //查询对应的楼层室
                $arr = [];
                foreach ($address as $k => $v) {
                    $arr[] = DB::table('data_floor')->where('id',$v)->value('f_name');
                }
                //将数组转为字符串
                $v1 = explode(',', $v1);
                //获取id
                $v1 = $v1[2];
                $d[$v1] = implode('',$arr);    
            }
            //判断
            if(empty($d)){
                //结果为空返回null
                return null;
            }
            //返回未巡更的层
            var_dump($d);
            return json_encode($d);

    }

    /**
     * 查询未巡更室下所有未巡更设备信息
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function YD_equipment_list()
    {
        //接收室id
        $shi_id = $_GET['shi_id'];
        //用室id获取层id
        $data = DB::table('data_floor')->where('id',$shi_id)->find();
        //获取室pid
        $pid = $data['pid'];
        //根据pid获取到层信息
        $ceng = DB::table('data_floor')->where('id',$pid)->find();
        //获取层pid
        $ceng_pid = $ceng['pid'];
        //获取层id
        $ceng_id = $ceng['id'];
        //根据层pid获取楼信息
        $lou = DB::table('data_floor')->where('id',$ceng_pid)->find();
        //获取楼id
        $lou_id = $lou['id'];
        //查询设备信息表
        $data = DB::table('data_floor')->select();
        foreach ($data as $key => $value) {
            //拼接楼层室id
            $ids = $lou_id.','.$ceng_id.','.$shi_id;
            //统计所有室下未巡更的设备信息  放入数组
            $res = DB::table('data_equipment')->where('eq_useaddress',$ids)->where('eq_status',1)->select();  

        }
        //判断
        if(empty($res)){
            //结果为空返回null
            return null;
        }
        var_dump($res);
        //成功返回结果
        return json_encode($res);

    }
}
