<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\DB;
class RepairController extends Controller
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
        //接受请求参数
        //用户名
        $u_name = isset($_GET['u_name']) ? $_GET['u_name'] : '';
        //手机号
        $u_tel = isset($_GET['u_tel']) ? $_GET['u_tel'] : '';
        //年龄
        $u_age = isset($_GET['u_age']) ? $_GET['u_age'] : '';
        //居住地址
        $u_address = isset($_GET['u_address']) ? $_GET['u_address'] : '';
        //目前岗位
        $u_post = isset($_GET['u_post']) ? $_GET['u_post'] : '';
        //账号
        $u_account = isset($_GET['u_account']) ? $_GET['u_account'] : '';
        //密码
        $u_pass = isset($_GET['u_pass']) ? md5($_GET['u_pass']) : '';
        //维修人状态为2
        $u_status = 2;
        //添加时间
        $time = date("Y-m-d H-i-s", time());
        //组装添加数据
        $data = ['u_name'=> $u_name, 'u_tel'=> $u_tel, 'u_age'=> $u_age, 'u_address'=> $u_address, 'u_post'=> $u_post, 'u_account'=> $u_account, 'u_pass'=> $u_pass, 'u_status'=> $u_status, 'created_at'=>$time ];
        //执行添加
        $res = DB::table('data_user')->insert($data);
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
}
