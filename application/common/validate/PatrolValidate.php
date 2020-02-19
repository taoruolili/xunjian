<?php  
namespace app\common\validate;
 
use think\Validate;


class PatrolValidate extends Validate
{
    protected $rule = [
                //utf-8 一个字符对应3个字母/数字 对应2个汉字(所以这里可以入3个字母/数字或者一个汉字)
                'u_name' => 'require|max:20',
                'u_age' => 'number|between:1,120',
                'u_tel' => 'mobile',
                'u_pass' => 'require',      
            ];
    protected $msg = [
                'u_name.require' => '222不能为空',
                'u_name.max' => '用户名最多不能超过20个字符',
                'u_age.number' => '年龄必须是数字',
                'u_age.between' => '年龄只能在1-120之间',
                'u_tel' => '手机号格式错误',
                'u_pass.require' => '不能为空',
            ];

    static public function pv($data){
    	$validate = new self;
    	$result = $validate->check($data);
    	if (!$result) {
            var_dump($validate->getError());
            //字段不合法，返回提示信息，状态码404
            return json_encode(['status'=> $validate->getError(), 'code'=> 400]);
        }
    }        
}


?>