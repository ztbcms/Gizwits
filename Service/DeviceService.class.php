<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Gizwits\Service;

class DeviceService extends GizwitsBaseAuthService {

    /**
     * 更新设备数据
     *
     * 没有数据则自动创建
     *
     * @param       $did
     * @param array $data
     * @return array
     */
    static function updateDeviceData($did, $data = []) {
        $db = D('Gizwits/GizwitsDevice');
        $device = $db->where(['did' => $did])->find();
        $time = time();

        if (isset($data['is_online'])) {
            $data['is_online'] = $data['is_online'] ? 1 : 0;
        }

        if (isset($data['is_disabled'])) {
            $data['is_disabled'] = $data['is_disabled'] ? 1 : 0;
        }

        if (isset($data['dev_label'])) {
            $data['dev_label'] = join(',', $data['dev_label']);
        }

        if(isset($data['attr'])){
            $data['attr'] = json_encode($data['attr']);
        }

        if(isset($data['updated_at'])){
            $data['cloud_update_at'] = $data['updated_at'];
            unset($data['updated_at']);
        }

        if ($device) {
            $ret = $db->where(['id' => $device['id']])->save(array_merge($data, [
                'update_time' => $time
            ]));
        } else {
            $ret = $db->add(array_merge($data, [
                'create_time' => $time,
                'update_time' => $time
            ]));
        }

        if ($ret) {
            return self::createReturn(true, null, '操作成功');
        } else {
            return self::createReturn(false, null, $db->getError());
        }
    }

    /**
     * 获取设备列表
     *
     * @param array $where
     * @param       $order
     * @param       $page
     * @param       $limit
     * @return array
     */
    static function getDeviceList($where = [], $order = 'id DESC', $page = 1, $limit = 20){
        return self::select('Gizwits/GizwitsDevice', $where, $order, $page, $limit);
    }

    /**
     * 获取设备
     * @param $did
     * @return mixed
     */
    static function getDeviceByDid($did){
        return self::find('Gizwits/GizwitsDevice', ['did' => $did]);
    }

    /**
     * 获取设备
     * @param $id
     * @return mixed
     */
    static function getDeviceById($id){
        return self::find('Gizwits/GizwitsDevice', ['id' => $id]);
    }

}