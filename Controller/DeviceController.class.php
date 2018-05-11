<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Gizwits\Controller;

use Common\Controller\AdminBase;
use Gizwits\Service\DeviceService;
use Gizwits\Service\GizwitsService;

/**
 * 设备管理
 */
class DeviceController extends AdminBase {

    /**
     * 设备列表页
     */
    function deviceList(){
        $this->display();
    }

    /**
     * 获取设备列表接口
     */
    function getDeviceList(){
        $where = I('where', []);

        foreach ($where as $key => $item) {
            if ($item == '') {
                unset($where[$key]);
            }
        }
        if($where['mac']){
            $where['mac'] = ['LIKE', '%'. $where['mac'] . '%'];
        }
        if($where['did']){
            $where['did'] = ['LIKE', '%'. $where['did'] . '%'];
        }


        $order = 'id DESC';
        $page = I('page', 1);
        $limit = I('limit', 20);


        $this->ajaxReturn(DeviceService::getDeviceList($where, $order, $page, $limit));
    }

    function deviceDetail(){
        $this->display();
    }

    function getDeviceByDid(){
        $did = I('did');
        $this->ajaxReturn(DeviceService::getDeviceByDid($did));
    }

    //实时同步获取设备信息接口
    function getSyncedDeviceByDid(){
        $did = I('did');
        $this->ajaxReturn(GizwitsService::syncDevice($did));
    }
}