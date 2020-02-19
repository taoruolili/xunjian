<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\DB;
use app\common\Tool;
class GotaskController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //查询巡更任务信息
        $data = DB::table('data_gotask')->select();
        //判断获取结果  如果为空说明查询不到此信息
        if(empty($data)){
            //查询不到返回null
            return null;
        }
        //返回结果
        return json_encode($data);
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
        //接受请求参数
        //巡更时间
        $ta_time = isset($_GET['ta_time']) ? $_GET['ta_time'] : '';
        //巡更路线
        $ta_route_id = isset($_GET['ta_route_id']) ? $_GET['ta_route_id'] : '';
        //巡更人
        $ta_u_id = isset($_GET['ta_u_id']) ? $_GET['ta_u_id'] : '';
        //备注描述
        $ta_des = isset($_GET['ta_des']) ? $_GET['ta_des'] : '';
        //组装添加数据
        $data = ['ta_time'=> $ta_time, 'ta_route_id'=> $ta_route_id, 'ta_u_id'=> $ta_u_id, 'ta_des'=> $ta_des];
        //判断是否添加多条巡更线路 以,为标识
        if(strpos($ta_route_id,',') !== false){
            //把路线id分割出来
            $id = explode(',', $ta_route_id);
            //用线路id循环添加每一条数据
            foreach ($id as $key => $value) {
                //组装添加条件
                $data = ['ta_time'=> $ta_time, 'ta_route_id'=> $value, 'ta_u_id'=> $ta_u_id, 'ta_des'=> $ta_des];
                //执行添加
                $res = DB::table('data_gotask')->insert($data); 
            }
        }else{
            //执行添加
            $res = DB::table('data_gotask')->insert($data);
        }
    
        //判断是否插入成功
        if($res){
            //成功
            return json_encode(['status'=> '成功', 'code'=> 200]);
        }

        //失败
        return json_encode(['status'=> '失败', 'code'=> 400]);
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
        //根据id查询要修改的数据
        //获取id
        $ta_id = $id;
        //根据id查询单条数据
        $data = DB::table('data_gotask')->find($ta_id);
        //判断获取结果  如果为空说明查询不到此id对应的数据
        if(empty($data)){
            //返回null
            return null;
        }
        //返回结果
        return json_encode($data);
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
        //要修改的id
        $ta_id = $id;
        //接受传入要修改的数据
        if(isset($_GET['ta_time'])){
            $data['ta_time'] = $_GET['ta_time'];
        }
        if(isset($_GET['ta_route_id'])){
            $data['ta_route_id'] = $_GET['ta_route_id'];
        }
        if(isset($_GET['ta_u_id'])){
            $data['ta_u_id'] = $_GET['ta_u_id'];
        }
        if(isset($_GET['ta_des'])){
            $data['ta_des'] = $_GET['ta_des'];
        }

        //执行修改数据
        $res = Db::table('data_gotask')->where('ta_id','=',$ta_id)->update($data);
        //判断修改是否成功
        if($res){
            //成功
            return json_encode(['status'=> '成功', 'code'=> 200]);
        }

        //失败
        return json_encode(['status'=> '失败', 'code'=> 400]);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //获取删除id
        $ta_id = $id;
        //执行删除
        $res = DB::table('data_gotask')->delete($ta_id);
        //判断删除是否成功
        if($res){
            //成功
            return json_encode(['status'=> '成功', 'code'=> 200]);
        }

        //失败
        return json_encode(['status'=> '失败', 'code'=> 400]);
    }


    /**
     * 显示正在登录巡更人的巡更任务 YD
     *
     * @return \think\Response
     */
    public function YD_gotask()
    {
        //获取session中用户名
        $u_name = session('u_name');
        //先用用户名去查询此用户对应的id
        $res = DB::table('data_user')->where('u_name',$u_name)->find();
        $u_id = $res['u_id'];
        //根据用户id查询此用户的所有巡更任务
        $data = DB::table('data_gotask')->where('ta_u_id',$u_id)->select();
        //循环获取ta_route_id
        foreach ($data as $key => $value) {
            //放入数组中
            $ta_route_id[] = $value['ta_route_id'];
        }
        //用每一条路线id循环查询路线对应的巡更点
        foreach ($ta_route_id as $k => $v) {
            //用路线id查询路线表
            $data1 = DB::table('data_route')->where('route_id',$v)->select();
            //var_dump($data1);
            //循环巡更点信息  
            foreach ($data1 as $k2 => $v2) {
                //route_point是巡更点id  也就是表中楼的id
                if(strpos($v2['route_point'],',') !== false){
                    $rp = explode(',',$v2['route_point']);
                    $arr = [];
                    $she = [];
                    $s = [];
                    foreach ($rp as $k3 => $v3) {
                        //一条线路对应多个巡更点 用id获取对应的f_name
                        $arr[] = DB::table('data_floor')->where('id',$v3)->value('f_name');
                        //用楼id去查询楼下所有设备
                        $she[] = DB::table('data_equipment')->where('eq_useaddress','like',$v3.'%')->select();
                        $status = Tool::isStatus_lou($she);
                        $s[] = $status;
                    }
                }else{
                    //一条线路对应1个巡更点 用id获取对应的f_name
                    $arr[0] = DB::table('data_floor')->where('id',$v2['route_point'])->value('f_name');
                    //用楼id去查询楼下所有设备
                    $she[] = DB::table('data_equipment')->where('eq_useaddress','like',$v2['route_point'].'%')->select();
                    $status = Tool::isStatus_lou($she);
                    $s[] = $status;
                }
                //判断状态  传入设备信息
                // $status = Tool::isStatus_lou($she);
                // $data1['status'] = $status;
                //将f_name添加到数组中
                $data1[0]['name'] = $arr;
                $data1[0]['s'] = $s;
                $data2[] = $data1;

            }

        }
        var_dump($data2);
        //返回结果
        return json_encode($data2);
    }
    
    /**
     * 显示调配巡更人
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function YD_edit()
    {
        //查询所有巡更人  不包括正在登录的巡更人
        $u_name = DB::table('data_user')->where('u_status',1)->where('u_name','neq',session('u_name'))->select();
        //接收参数楼id
        $lou_id = $_GET['lou_id'];
        //用楼id去判断属于哪条线路 得到线路信息
        $route = DB::table('data_route')->where('route_point','like','%'.$lou_id.'%')->find();
        //用楼id查询未巡更设备信息
        $she = DB::table('data_equipment')->where('eq_useaddress','like',$lou_id.'%')->where('eq_status',1)->select();
        //判断有没有未巡更信息
        if(empty($she)){
            $res[] = [];
        }else{
            //循环获取到未巡更设备地点
            foreach ($she as $key => $value) {
                //获取地点字段
                $address = $value['eq_useaddress'];
                //用,分割
                $address = explode(',', $address);
                //查询对应的楼层室
                $arr = [];
                foreach ($address as $k => $v) {
                    $arr[] = DB::table('data_floor')->where('id',$v)->value('f_name');
                }
                //将数组转为字符串
                $res[] = implode('',$arr);
            }
        }
        //将巡更人加入数组中
        $res['u_name'] = $u_name; 
        // var_dump($route);die;
        $res['route'] = $route;
        var_dump($res);
        return json_encode($res);
    }

    /**
     * 执行调配巡更人
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function YD_update()
    {
        //接收线路id
        $route_id = $_GET['route_id'];
        //接收要修改巡更人id
        $ta_u_id = $_GET['u_id'];
        //获取正在登录用户id
        $data = DB::table('data_user')->where('u_name',session('u_name'))->find();
        $u_id = $data['u_id'];
        //首先用楼id查询到正在登录巡更人对应巡更任务id,分配巡更人  线路id对应ta_route_id  用户id对应ta_u_id
        $res = DB::table('data_gotask')->where('ta_u_id',$u_id)->where('ta_route_id',$route_id)->find();
        //获取巡更任务表id
        $ta_id = $res['ta_id'];
        //修改数据
        $res = DB::table('data_gotask')->update(['ta_u_id'=> $ta_u_id,'ta_id'=>$ta_id]);
        //判断修改是否成功
        if($res){
            //成功
            return json_encode(['status'=> '成功', 'code'=> 200]);
        }

        //失败
        return json_encode(['status'=> '失败', 'code'=> 400]);
    }
    

}
