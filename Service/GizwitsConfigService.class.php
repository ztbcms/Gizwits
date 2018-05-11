<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Gizwits\Service;

use Gizwits\Entity\GizwitsConfig;
use Gizwits\Model\GizwitsConfigModel;
use System\Service\BaseService;

class GizwitsConfigService extends BaseService {

    /**
     * 获取配置
     *
     */
    static function getConfig(){
        $db = D('Gizwits/GizwitsConfig');
        $configRecord = $db->where(['is_default' => GizwitsConfigModel::IS_DEFAULT_YES])->find();

        $config = self::loadConfig($configRecord);

        //如果当前超时，则立马更新一次
        //当设备多的时候，真的出现这种情况，如果立马更新token，服务器负载会非常高，不建议这么操作
//        if($configRecord && $configRecord['user_token_expire_at'] <= time()){
//            GizwitsService::updateUserToken($config);
//            return self::getConfig();
//
//        }
        return $config;
    }

    /**
     * key-value 转换为 GizwitsConfig 对象
     *
     * @param array $configRecord
     * @return GizwitsConfig
     */
    static function loadConfig($configRecord = []){
        $config = new GizwitsConfig();
        $config->setAppId($configRecord['app_id']);
        $config->setAppSecret($configRecord['app_secret']);
        $config->setProductKey($configRecord['product_key']);
        $config->setProductSecret($configRecord['product_secret']);
        $config->setIsDefault($configRecord['is_default']);
        $config->setFrequencySyncDev($configRecord['frequency_sync_dev']);
        $config->setPhoneId($configRecord['phone_id']);
        $config->setUserToken($configRecord['user_token']);
        $config->setUserTokenExpireAt($configRecord['user_token_expire_at']);

        return $config;
    }

    /**
     * 更新配置
     *
     * @param       $product_key
     * @param array $data
     * @return array
     */
    static function updateConfig($product_key, $data = []){
        $db = D('Gizwits/GizwitsConfig');
        $db->where(['product_key' => $product_key])->save($data);

        return self::createReturn(true, null, '操作成功');
    }

}