<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Gizwits\Service;

use Gizwits\Entity\GizwitsConfig;

/**
 * 机智云服务接口
 *
 * 此处是高层次的封装，一般来说 你只需要调用这个服务
 */
class GizwitsService extends GizwitsBaseService {

    //== 命令类型
    //开机
    const CMD_TYPE_ONOFF = 1;
    const CMD_TYPE_SET_DEV_CONFIG = 2;
    const CMD_TYPE_SET_LVXIN_CONFIG = 3;
    const CMD_TYPE_SET_CHECK = 4;

    //工作使能
    const CMD_ONOFF_OFF = 0;
    const CMD_ONOFF_ON = 1;
    const CMD_ONOFF_DEBUG_ON = 2;

    /**
     * 更新用户访问凭证
     *
     * 该凭证有效期为7日，请注意定期更新
     *
     * @param GizwitsConfig $config
     * @return array
     */
    static function updateUserToken(GizwitsConfig $config) {
        $service = new UserService($config);
        $result = $service->anonymousLogin();

        $save_data = [
            'user_token' => $result['data']['token'],
            'user_token_expire_at' => $result['data']['expire_at'],
        ];

        return GizwitsConfigService::updateConfig($config->getProductKey(), $save_data);

    }

    /**
     * 同步设备状态
     *
     * @param string        $did 设备ID
     * @return array
     */
    static function syncDevice($did) {
        $service = ControlService::getInstance();
        $service->getDeviceDetail($did);
        $service->getDeviceLatestData($did);

        return DeviceService::getDeviceByDid($did);
    }

    /**
     * 开关命令
     *
     * @param string        $did
     * @param int           $work_enable
     * @return array
     */
    static function cmd_onOff($did, $work_enable) {
        $service = ControlService::getInstance();

        return $service->control($did, [
            'cmd_type' => GizwitsService::CMD_TYPE_ONOFF,
            'work_enable' => $work_enable
        ]);
    }

    /**
     * 设置终端配置信息命令
     *
     * @param       $did
     * @param array $data
     * @return array
     */
    static function cmd_set_dev_config($did, $data = []){
        $service = ControlService::getInstance();

        $cmd_data = ['cmd_type' => GizwitsService::CMD_TYPE_SET_DEV_CONFIG];
        if(isset($data['tds_in_dt'])){
            $cmd_data['tds_in_dt'] = $data['tds_in_dt'];
        }
        if(isset($data['tds_out_dt'])){
            $cmd_data['tds_out_dt'] = $data['tds_out_dt'];
        }
        if(isset($data['speed_in'])){
            $cmd_data['speed_in'] = $data['speed_in'];
        }
        if(isset($data['speed_out'])){
            $cmd_data['speed_out'] = $data['speed_out'];
        }
        if(isset($data['used_amount'])){
            $cmd_data['used_amount'] = $data['used_amount'];
        }

        return $service->control($did, $cmd_data);
    }

    /**
     * 设置终端配置信息命令
     *
     * @param       $did
     * @param array $data
     * @return array
     */
    static function cmd_set_lvxin_config($did, $data = []){
        $service = ControlService::getInstance();

        $cmd_data = ['cmd_type' => GizwitsService::CMD_TYPE_SET_LVXIN_CONFIG];
        if(isset($data['poweron_time1'])){
            $cmd_data['poweron_time1'] = $data['poweron_time1'];
        }
        if(isset($data['use_amount1'])){
            $cmd_data['use_amount1'] = $data['use_amount1'];
        }
        if(isset($data['poweron_time2'])){
            $cmd_data['poweron_time2'] = $data['poweron_time2'];
        }
        if(isset($data['use_amount2'])){
            $cmd_data['use_amount2'] = $data['use_amount2'];
        }
        if(isset($data['poweron_time3'])){
            $cmd_data['poweron_time3'] = $data['poweron_time3'];
        }
        if(isset($data['use_amount3'])){
            $cmd_data['use_amount3'] = $data['use_amount3'];
        }
        if(isset($data['poweron_time4'])){
            $cmd_data['poweron_time4'] = $data['poweron_time4'];
        }
        if(isset($data['use_amount4'])){
            $cmd_data['use_amount4'] = $data['use_amount4'];
        }
        if(isset($data['poweron_time5'])){
            $cmd_data['poweron_time5'] = $data['poweron_time5'];
        }
        if(isset($data['use_amount5'])){
            $cmd_data['use_amount5'] = $data['use_amount5'];
        }
        if(isset($data['poweron_time6'])){
            $cmd_data['poweron_time6'] = $data['poweron_time6'];
        }
        if(isset($data['use_amount6'])){
            $cmd_data['use_amount6'] = $data['use_amount6'];
        }
        if(isset($data['poweron_time7'])){
            $cmd_data['poweron_time7'] = $data['poweron_time7'];
        }
        if(isset($data['use_amount7'])){
            $cmd_data['use_amount7'] = $data['use_amount7'];
        }

        return $service->control($did, $cmd_data);
    }

    /**
     * 设置终端进入检修命令
     *
     * @param       $did
     * @param       $check_status
     * @return array
     */
    static function cmd_set_check($did, $check_status){
        $service = ControlService::getInstance();

        $cmd_data = [
            'cmd_type' => GizwitsService::CMD_TYPE_SET_CHECK,
            'check_status' => $check_status,
        ];

        return $service->control($did, $cmd_data);
    }

}