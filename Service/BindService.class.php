<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Gizwits\Service;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

/**
 * 绑定管理
 */
class BindService extends GizwitsBaseAuthService {

    /**
     * 通过 MAC 地址绑定设备
     *
     * 返回参数请参考：http://docs.gizwits.com/zh-cn/Cloud/openapi_apps.html#%E9%80%9A%E8%BF%87-MAC-%E5%9C%B0%E5%9D%80%E7%BB%91%E5%AE%9A%E8%AE%BE%E5%A4%87
     *
     * @param string  $mac
     * @param string $remark
     * @param string $dev_alias
     * @return array
     */
    function bindMac($mac, $remark = '', $dev_alias = '') {
        $client = HttpClientService::getHttpClient();
        $timestamp = time();
        $request = new Request('POST', GizwitsApiService::dev_bind_mac(), [
                'X-Gizwits-Application-Id' => $this->getGizwitsConfig()->getAppId(),
                'X-Gizwits-User-token' => $this->getGizwitsConfig()->getUserToken(),
                'X-Gizwits-Timestamp' => $timestamp,
                'X-Gizwits-Signature' => $this->signature($timestamp)
            ], json_encode([
            'product_key' => $this->getGizwitsConfig()->getProductKey(),
            'mac' => $mac,
            'remark' => $remark,
            'dev_alias' => $dev_alias,
            'set_owner' => 0,//是否设置成 owner，只对开启了设备分享功能的产品有效；0（默认值）：不设置成owner，1：设置成owner
        ]));

        $response = $ret = null;
        try {
            $response = $client->send($request);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
            }
        }

        if ($response) {
            $body = (string)$response->getBody();
            $ret = json_decode($body, true);
        }

        if ($ret) {
            if (isset($ret['error_code'])) {
                return self::createReturn(false, null);
            } else {
                return DeviceService::updateDeviceData($ret['did'], $ret);
            }
        } else {
            return self::createReturn(false, null);
        }
    }


}