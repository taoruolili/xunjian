<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\DB;
class EquipmentController extends Controller
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
        //接受请求参数
        //采购时间
        $eq_purchase_time = isset($_GET['eq_purchase_time']) ? $_GET['eq_purchase_time'] : '';
        //设备行号
        $eq_model = isset($_GET['eq_model']) ? $_GET['eq_model'] : '';
        //设备名称
        $eq_name = isset($_GET['eq_name']) ? $_GET['eq_name'] : '';
        //设备图片
        $eq_img = isset($_GET['eq_img']) ? $_GET['eq_img'] : '';
        //设备使用地点
        $eq_useaddress = isset($_GET['eq_useaddress']) ? $_GET['eq_useaddress'] : '';
        //设备维保时间
        $eq_main_time = isset($_GET['eq_main_time']) ? $_GET['eq_main_time'] : '';
        //设备状态
        $eq_state = isset($_GET['eq_state']) ? $_GET['eq_state'] : '';
        //设备巡更情况
        $eq_status = isset($_GET['eq_status']) ? $_GET['eq_status'] : '';
        //组装添加条件
        $data = ['eq_purchase_time'=> $eq_purchase_time, 'eq_model'=> $eq_model, 'eq_name'=> $eq_name, 'eq_img'=> $eq_img, 'eq_useaddress'=> $eq_useaddress, 'eq_main_time'=> $eq_main_time, 'eq_state'=> $eq_state, 'eq_status'=> $eq_status];
        //执行添加
        $res = DB::table('data_equipment')->insert($data);
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
        $eq_id = $id;
        //根据id查询单条数据
        $data = DB::table('data_equipment')->find($eq_id);
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
        $eq_id = $id;
        //接受传入要修改的数据
        if(isset($_GET['eq_purchase_time'])){
            $data['eq_purchase_time'] = $_GET['eq_purchase_time'];
        }
        if(isset($_GET['eq_model'])){
            $data['eq_model'] = $_GET['eq_model'];
        }
        if(isset($_GET['eq_name'])){
            $data['eq_name'] = $_GET['eq_name'];
        }
        if(isset($_GET['eq_img'])){
            $data['eq_img'] = $_GET['eq_img'];
        }
        if(isset($_GET['eq_useaddress'])){
            $data['eq_useaddress'] = $_GET['eq_useaddress'];
        }
        if(isset($_GET['eq_main_time'])){
            $data['eq_main_time'] = $_GET['eq_main_time'];
        }
        if(isset($_GET['eq_state'])){
            $data['eq_state'] = $_GET['eq_state'];
        }
        if(isset($_GET['eq_status'])){
            $data['eq_status'] = $_GET['eq_status'];
        }
        //执行修改数据
        $res = Db::table('data_equipment')->where('eq_id','=',$eq_id)->update($data);
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
        $eq_id = $id;
        //执行删除
        $res = DB::table('data_equipment')->delete($eq_id);
        //判断删除是否成功
        if($res){
            //成功
            return json_encode(['status'=> '成功', 'code'=> 200]);
        }

        //失败
        return json_encode(['status'=> '失败', 'code'=> 400]);
    }
}
