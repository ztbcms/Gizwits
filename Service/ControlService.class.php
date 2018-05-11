<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Gizwits\Service;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

/**
 * 设备远程监控
 */
class ControlService extends GizwitsBaseAuthService {

    /**
     * 获取实例
     *
     * @var ControlService
     */
    static private $instance;

    static function getInstance() {
        if (self::$instance) {
            return self::$instance;
        }
        $gizwitsConfig = GizwitsConfigService::getConfig();

        return new ControlService($gizwitsConfig);
    }

    /**
     * 控制设备
     *
     * @param       $did
     * @param array $attrs
     * @return array
     */
    function control($did, $attrs = []) {
        $client = HttpClientService::getHttpClient();
        $request = new Request('POST', GizwitsApiService::dev_control($did), [
            'X-Gizwits-Application-Id' => $this->getGizwitsConfig()->getAppId(),
            'X-Gizwits-User-token' => $this->getGizwitsConfig()->getUserToken(),
        ], json_encode([
            'attrs' => $attrs
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
                return self::createReturn(false, $ret);
            } else {
                return self::createReturn(true, $ret);
            }
        } else {
            return self::createReturn(true, $ret);
        }
    }

    /**
     * 获取设备最新状态
     * 该接口获取的是 24 小时内，设备最近一次上报的数据点值。
     *
     * @param string $did 设备ID
     * @return array
     */
    function getDeviceLatestData($did) {
        $client = HttpClientService::getHttpClient();
        $request = new Request('GET', GizwitsApiService::dev_latest_data($did), [
            'X-Gizwits-Application-Id' => $this->getGizwitsConfig()->getAppId(),
        ], json_encode([]));

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

                DeviceService::updateDeviceData($did, array_merge($ret, ['sync_at' => time()]));

                return self::createReturn(true, $ret);
            }
        } else {
            return self::createReturn(false, null);
        }
    }

    /**
     * 获取设备详情
     *
     * 用户判断其是否在线
     *
     * @param string $did 设备ID
     * @return array
     */
    function getDeviceDetail($did) {
        $client = HttpClientService::getHttpClient();
        $request = new Request('GET', GizwitsApiService::dev_detail($did), [
            'X-Gizwits-Application-Id' => $this->getGizwitsConfig()->getAppId(),
            'X-Gizwits-User-token' => $this->getGizwitsConfig()->getUserToken()
        ], json_encode([]));

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

                DeviceService::updateDeviceData($did, array_merge($ret, ['sync_at' => time()]));

                return self::createReturn(true, null);
            }
        } else {
            return self::createReturn(false, null);
        }
    }

}