<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
/**
* Author:wutao
*/
Route::get('/', function () {
    return 'hello,ThinkPHP5!';
});

// Route::get('hello/:name', 'index/hello');

// return [

// ];


/**
*移动端
*/
//登录路由
Route::rule('YD_login','admin/LoginController/YD_login');
//移动端巡更列表
Route::group('',function(){
	//显示正在登录巡更人的所有巡更任务 
	Route::rule('/YD_gotask','admin/GotaskController/YD_gotask');
	//显示调配巡更人
	Route::rule('/YD_edit','admin/GotaskController/YD_edit');
	//执行分配调配巡更人  传入线路id和要修改巡更人id
	Route::rule('/YD_update','admin/GotaskController/YD_update');
	//用楼id查询所有层信息和巡更信息
	Route::rule('/YD_floor_layer_list/:id','admin/FloorController/YD_floor_layer_list');
	//用层id查询所有的室信息  
	Route::rule('/YD_floor_room_list','admin/FloorController/YD_floor_room_list');
	//用楼层室内id去查询室内所有未巡更(status)设备信息  传入楼层室id  用 , 隔开
	Route::rule('/YD_room_equipment','admin/FloorController/YD_room_equipment');
	//巡更按钮 未巡更点对应未巡更所有层信息  传入楼id
	Route::rule('YD_ceng_list','admin/FloorController/YD_ceng_list');
	//层下面对应所有未巡室信息  传入层id
	Route::rule('YD_shi_list','admin/FloorController/YD_shi_list');
	//室下面对应所有未巡设备信息  传入室id
	Route::rule('YD_equipment_list','admin/FloorController/YD_equipment_list');

});


/**
*PC端
*/
//执行登录
Route::rule('/login','admin/LoginController/login');
//退出登录
Route::rule('/logout','admin/LoginController/logout');

//短信提醒
Route::rule('/short_message','admin/ToolsController/short_message');

//巡更人路由
Route::group('',function(){
	//巡更人员信息
	Route::rule('/XGuser_list','admin/UserController/xg_list');
	//添加巡更人  姓名，电话号码，密码必填
	Route::rule('/XGuser_add','admin/PatrolController/save');
	//查询要修改巡更人信息 :id传入要查询巡更人id
	Route::rule('/XGuser_edit/:id','admin/PatrolController/edit');
	//执行修改巡更人 :id传入要修改的id
	Route::rule('/XGuser_update/:id','admin/PatrolController/update');
	//删除巡更人  :id传入要删除的id
	Route::rule('/XGuser_delete/:id','admin/PatrolController/delete');
});

//巡更路线路由
Route::group('',function(){
	//巡更路线信息
	Route::rule('/XGroute_index','admin/PatrolRouteController/index');
	//添加巡更路线  
	Route::rule('/XGroute_add','admin/PatrolRouteController/save');
	//查询要修改巡更路线信息  :id传入要查询巡更路线id
	Route::rule('/XGroute_edit/:id','admin/PatrolRouteController/edit');
	//执行修改路线
	Route::rule('/XGroute_update/:id','admin/PatrolRouteController/update');
	//删除巡更线路
	Route::rule('/XGroute_delete/:id','admin/PatrolRouteController/delete');
});

//签到点路由
Route::group('',function(){
	//签到点信息
	Route::rule('/signpoint_index','admin/SignpointController/index');
	//添加签到点  
	Route::rule('/signpoint_add','admin/SignpointController/save');
	//查询要修改签到点信息  :id传入要查询签到点id
	Route::rule('/signpoint_edit/:id','admin/SignpointController/edit');
	//执行修改签到点
	Route::rule('/signpoint_update/:id','admin/SignpointController/update');
	//删除签到点
	Route::rule('/signpoint_delete/:id','admin/SignpointController/delete');
});

//巡更任务路由
Route::group('',function(){
	//巡更任务信息
	Route::rule('/gotask_index','admin/GotaskController/index');
	//添加巡更任务   多个用,隔开 
	Route::rule('/gotask_add','admin/GotaskController/save');
	//查询要修改巡更任务  :id传入要查询巡更任务id
	Route::rule('/gotask_edit/:id','admin/GotaskController/edit');
	//执行修改巡更任务
	Route::rule('/gotask_update/:id','admin/GotaskController/update');
	//删除巡更任务
	Route::rule('/gotask_delete/:id','admin/GotaskController/delete');
});

//设备信息路由
Route::group('',function(){
	//添加设备信息  
	Route::rule('/equipment_add','admin/EquipmentController/save');
	//用设备id查询单条设备
	Route::rule('/equipment_edit/:id','admin/EquipmentController/edit');
	//执行修改设备信息
	Route::rule('/equipment_update/:id','admin/EquipmentController/update');
	//删除设备信息
	Route::rule('/equipment_delete/:id','admin/EquipmentController/delete');
});

//楼层管理路由
Route::group('',function(){
	//添加楼层信息  参数 楼名称和楼层数量
	Route::rule('/floor_add','admin/FloorController/save');
	//添加室信息 需要传入室名称 父级(层)id
	Route::rule('/floor_room_add','admin/FloorController/room_save');
	//查询楼信息  返回所有楼名称
	Route::rule('/floor_list','admin/FloorController/floor_list');
	//查询楼对应的层信息  传入楼id 返回所有层信息
	Route::rule('/floor_layer_list/:id','admin/FloorController/floor_layer_list');
	//查询楼层室信息  楼中包含层  层中包含室内
	Route::rule('/floor_room_list','admin/FloorController/floor_room_list');
});


//维修人路由
Route::group('',function(){
	//维修人员信息
	Route::rule('/WXuser_list','admin/UserController/wx_list');
	//添加维修人 姓名，电话号码，密码必填
	Route::rule('/WXuser_add','admin/RepairController/save');
});

//管理员路由
Route::group('',function(){
	//管理员信息
	Route::rule('/ADMINuser_list','admin/UserController/admin_list');
});

