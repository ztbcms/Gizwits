<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Gizwits\CronScript;

use Cron\Base\Cron;
use Gizwits\Service\GizwitsConfigService;
use Gizwits\Service\GizwitsService;

/**
 * 更新用户的token
 *
 * 建议每日 1:00 执行
 */
class UpdateUserToken extends Cron {

    /**
     * 执行任务回调
     *
     * @param string $cronId
     */
    public function run($cronId) {
        $db = D('Gizwits/GizwitsConfig');
        $limit = time() + 3 * 24 * 60 * 60;//距离过期还有3日
        $configList = $db->where(['user_token_expire_at' => ['LT', $limit]])->select();

        foreach ($configList as $index => $config) {
            $gizwitsConfig = GizwitsConfigService::loadConfig($config);
            GizwitsService::updateUserToken($gizwitsConfig);
        }
    }
}