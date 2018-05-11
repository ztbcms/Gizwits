<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Gizwits\CronScript;

use Cron\Base\Cron;
use Gizwits\Service\GizwitsConfigService;
use Gizwits\Service\GizwitsService;

/**
 * 同步设备信息
 *
 * 建议执行频率 每 5 分钟
 */
class SyncDevice extends Cron {

    /**
     * 执行任务回调
     *
     * @param string $cronId
     */
    public function run($cronId) {
        $gizwitsConfig = GizwitsConfigService::getConfig();

        $limit_time = time() - $gizwitsConfig->getFrequencySyncDev();

        $device = $this->getNeedSyncDevice($limit_time, 0);

        while($device){
            GizwitsService::syncDevice($gizwitsConfig, $device['did']);

            $device = $this->getNeedSyncDevice($limit_time, $device['id']);
        }
    }

    //获取一个需要同步的设备
    private function getNeedSyncDevice($limit_time, $last_device_id){
        $db = D('Gizwits/GizwitsDevice');
        $result = $db->where(['sync_at' => ['LT', $limit_time], 'id' => ['GT', $last_device_id] ])->find();

        return $result;

    }
}