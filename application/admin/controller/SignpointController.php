<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\DB;
class SignpointController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //查询签到点信息
        $data = DB::table('data_signpoint')->select();
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
        //签到点名称
        $sp_name = isset($_GET['sp_name']) ? $_GET['sp_name'] : '';
        //点
        $sp_time = isset($_GET['sp_time']) ? $_GET['sp_time'] : '';
        //组装添加数据
        $data = ['sp_name'=> $sp_name, 'sp_time'=> $sp_time];
        //执行添加
        $res = DB::table('data_signpoint')->insert($data);
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
        //接收参数
        //接收id
        $sp_id = $id;
        //查询单条数据
        $data = DB::table('data_signpoint')->find($sp_id);
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
        $sp_id = $id;
        //接受传入要修改的数据
        if(isset($_GET['sp_name'])){
            $data['sp_name'] = $_GET['sp_name'];
        }
        if(isset($_GET['sp_time'])){
            $data['sp_time'] = $_GET['sp_time'];
        }
       
        //执行修改数据
        $res = Db::table('data_signpoint')->where('sp_id','=',$sp_id)->update($data);
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
        $sp_id = $id;
        //执行删除
        $res = DB::table('data_signpoint')->delete($sp_id);
        //判断删除是否成功
        if($res){
            //成功
            return json_encode(['status'=> '成功', 'code'=> 200]);
        }

        //失败
        return json_encode(['status'=> '失败', 'code'=> 400]);
    }
}
