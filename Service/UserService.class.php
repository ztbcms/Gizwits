<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Gizwits\Service;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

/**
 * 用户管理
 */
class UserService extends GizwitsBaseService {

    /**
     * 匿名登录
     */
    function anonymousLogin() {
        $client = HttpClientService::getHttpClient();

        $request = new Request('POST', GizwitsApiService::user_anonymous_login(),
            ['X-Gizwits-Application-Id' => $this->getGizwitsConfig()->getAppId()],
            json_encode(['phone_id' => $this->getGizwitsConfig()->getAppId()]));

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
            return self::createReturn(false, $ret);
        }
    }

}