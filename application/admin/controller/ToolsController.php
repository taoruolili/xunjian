<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Validate;
use sms\Send;
class ToolsController extends Controller
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
     * 短信提醒
     *
     * @param  tel
     * @return \think\Response
     */
    public function short_message()
    {
        //接收电话号码
        $tel = $_GET['tel'];
        //判断电话号码是否为空
        if(empty($tel)){
            return json_encode(['status'=> '电话号码不能为空', 'code'=> 400]);
        }
        //验证字段值合法
        $rule = [
                //utf-8 一个字符对应3个字母/数字 对应2个汉字(所以这里可以入3个字母/数字或者一个汉字)
                // 'tel' => 'require',
                'tel' => 'mobile', 
            ];
        $msg = [
                // 'tel.require' => '手机号不能为空',
                'tel.mobile' => '手机号格式错误',
            ];
        //调用验证器类来验证字段                    
        $validate = new Validate($rule, $msg);
        $result = $validate->check(['tel'=>$tel]);
        if (!$result) {
            var_dump($validate->getError());
            //电话号码不合法，返回提示信息，状态码404
            return json_encode(['status'=> $validate->getError(), 'code'=> 400]);
        }
        //调用函数发送
        $res = Send::SendSms('8888',$tel);
        var_dump($res);
    }
}
