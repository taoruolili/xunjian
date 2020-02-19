<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\DB;
class UserController extends Controller
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
     * 显示创建资源表单页
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
        //
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
     * 巡更人列表
     *
     * @return \think\Response
     */
    public function xg_list()
    {
        //获取巡更人列表
        $data = DB::table('data_user')->where('u_status',1)->select();
        //判断获取结果  如果为空说明没有巡更人
        if(empty($data)){
            //巡更人为空返回null
            return null;
        }
        // var_dump($data);die;

        //返回结果
        return json_encode($data,JSON_FORCE_OBJECT);
        // return json_encode($data,JSON_UNESCAPED_UNICODE);
    }

    /**
     * 维修人列表
     *
     * @return \think\Response
     */
    public function wx_list()
    {
        //获取维修人列表
        $data = DB::table('data_user')->where('u_status',2)->select();
        //判断获取结果  如果为空说明没有维修人
        if(empty($data)){
            //维修人为空返回null
            return null;
        }
        //返回结果
        return json_encode($data);
    }

    /**
     * 管理员列表
     *
     * @return \think\Response
     */
    public function admin_list()
    {
        //获取维修人列表
        $data = DB::table('data_user')->where('u_status',3)->select();
        //判断获取结果  如果为空说明没有管理员
        if(empty($data)){
            //管理员为空返回null
            return null;
        }
        //返回结果
        return json_encode($data);
    }
}
