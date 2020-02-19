<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\DB;
class PatrolRouteController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //显示巡更路线列表
        $data = DB::table('data_route')->select();
        //判断获取结果 
        if(empty($data)){
            //巡更人为空返回null
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
        //线路名称
        $route_name = isset($_GET['route_name']) ? $_GET['route_name'] : '';
        //巡更点
        $route_point = isset($_GET['route_point']) ? $_GET['route_point'] : '';
        //组装添加数据
        $data = ['route_name'=> $route_name, 'route_point'=> $route_point];
        //执行添加
        $res = DB::table('data_route')->insert($data);
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
        $route_id = $id;
        //根据id查询单条数据
        $data = DB::table('data_route')->find($route_id);
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
        $route_id = $id;
        //接受传入要修改的数据
        if(isset($_GET['route_name'])){
            $data['route_name'] = $_GET['route_name'];
        }
        if(isset($_GET['route_point'])){
            $data['route_point'] = $_GET['route_point'];
        }
       
        //执行修改数据
        $res = Db::table('data_route')->where('route_id','=',$route_id)->update($data);
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
        $route_id = $id;
        //执行删除
        $res = DB::table('data_route')->delete($route_id);
        //判断删除是否成功
        if($res){
            //成功
            return json_encode(['status'=> '成功', 'code'=> 200]);
        }

        //失败
        return json_encode(['status'=> '失败', 'code'=> 400]);
    }
}
