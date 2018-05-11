<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Gizwits\Service;

/**
 * 机智云接口
 */
class GizwitsApiService {

    static private $baseUrl = 'http://api.gizwits.com';

    //匿名登录
    static function user_anonymous_login(){
        return self::$baseUrl . '/app/users';
    }

    //绑定mac地址
    static function dev_bind_mac(){
        return self::$baseUrl . '/app/bind_mac';
    }

    //设备控制
    static function dev_control($did){
        return self::$baseUrl . '/app/control/' . $did;
    }

    //获取设备最新状态
    static function dev_latest_data($did){
        return self::$baseUrl . '/app/devdata/' . $did . '/latest';
    }

    //获取设备详情
    static function dev_detail($did){
        return self::$baseUrl . '/app/devices/' . $did;
    }

}