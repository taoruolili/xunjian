<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Validate;
use think\DB;
class PatrolController extends Controller
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
        header("content-type：application/json;charset=utf-8");
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
        $u_pass = isset($_GET['u_pass']) ? $_GET['u_pass'] : '';
        //巡更人状态为1
        $u_status = 1;
        //添加时间
        $time = date("Y-m-d H-i-s", time());
        //组装添加数据
        $data = ['u_name'=> $u_name, 'u_tel'=> $u_tel, 'u_age'=> $u_age, 'u_address'=> $u_address, 'u_post'=> $u_post, 'u_account'=> $u_account, 'u_pass'=> $u_pass, 'u_status'=> $u_status, 'created_at'=>$time ];

        //验证字段值合法
        $rule = [
                //utf-8 一个字符对应3个字母/数字 对应2个汉字(所以这里可以入3个字母/数字或者一个汉字)
                'u_name' => 'require|max:20',
                'u_age' => 'number|between:1,120',
                'u_tel' => 'mobile',
                'u_pass' => 'require|min:6',
            ];
        $msg = [
                'u_name.require' => '用户名不能为空',
                'u_name.max' => '用户名最多不能超过20个字符',
                'u_age.number' => '年龄必须是数字',
                'u_age.between' => '年龄只能在1-120之间',
                'u_tel.mobile' => '手机号格式错误',
                'u_pass.require' => '密码不能为空',
                'u_pass.min' => '密码不能小于6位',
            ];
        //调用验证器类来验证字段                    
        $validate = new Validate($rule, $msg);
        $result = $validate->check($data);

        if (!$result) {
            //字段不合法，返回提示信息，状态码404
            return json_encode(['status'=> $validate->getError(), 'code'=> 400]);
        }

        //密码进行md5加密
        $data['u_pass'] = md5($data['u_pass']);
        //执行添加
        $res = DB::table('data_user')->insert($data);
        //判断是否插入成功
        if($res){
            //成功
            return json_encode(['status'=> '成功', 'code'=> 200]);
            // return json_encode($a);
        }

        //失败 ,JSON_UNESCAPED_UNICODE
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
        //获取id
        $u_id = $id;
        //根据id查询单条数据
        $data = DB::table('data_user')->find($u_id);
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
        $u_id = $id;
        //接受传入要修改的数据
        if(isset($_GET['u_name'])){
            $data['u_name'] = $_GET['u_name'];
        }
        if(isset($_GET['u_age'])){
            $data['u_age'] = $_GET['u_age'];
        }
        if(isset($_GET['u_tel'])){
            $data['u_tel'] = $_GET['u_tel'];
        }
        if(isset($_GET['u_address'])){
            $data['u_address'] = $_GET['u_address'];
        }
        if(isset($_GET['u_tel'])){
            $data['u_tel'] = $_GET['u_tel'];
        }
        if(isset($_GET['u_post'])){
            $data['u_post'] = $_GET['u_post'];
        }
        if(isset($_GET['u_account'])){
            $data['u_account'] = $_GET['u_account'];
        }
        if(isset($_GET['u_pass'])){
            var_dump(strlen($_GET['u_pass']));
            //判断密码长度不能小于6位
            if(strlen($_GET['u_pass']) < 6){
                return json_encode(['status'=> '密码长度不能小于6位', 'code'=> 400]);
            }
            //对密码进行加密
            $data['u_pass'] = md5($_GET['u_pass']);
        }

        //验证字段值合法
        $rule = [
                //utf-8 一个字符对应3个字母/数字 对应2个汉字(所以这里可以入3个字母/数字或者一个汉字)
                'u_name' => 'require|max:20',
                'u_age' => 'number|between:1,120',
                'u_tel' => 'mobile',  
            ];
        $msg = [
                'u_name.require' => '用户名不能为空',
                'u_name.max' => '用户名最多不能超过20个字符',
                'u_age.number' => '年龄必须是数字',
                'u_age.between' => '年龄只能在1-120之间',
                'u_tel.mobile' => '手机号格式错误',
            ];
        //调用验证器类来验证字段                    
        $validate = new Validate($rule, $msg);
        $result = $validate->check($data);
        if (!$result) {
            var_dump($validate->getError());
            //字段不合法，返回提示信息，状态码404
            return json_encode(['status'=> $validate->getError(), 'code'=> 400]);
        }
        //执行修改数据
        $res = Db::table('data_user')->where('u_id','=',$u_id)->update($data);
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
        $u_id = $id;
        //执行删除
        $res = DB::table('data_user')->delete($u_id);
        //判断删除是否成功
        if($res){
            //成功
            return json_encode(['status'=> '成功', 'code'=> 200]);
        }

        //失败
        return json_encode(['status'=> '失败', 'code'=> 400]);

    }
}
