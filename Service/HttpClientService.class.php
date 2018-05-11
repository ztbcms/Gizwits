<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Gizwits\Service;

use GuzzleHttp\Client;
use System\Service\BaseService;

class HttpClientService extends BaseService {

    /**
     * @var Client
     */
    static private $httpClient;


    static function getHttpClient(){
        if(self::$httpClient){
            return self::$httpClient;
        }else{
            return self::$httpClient = new Client();

        }
    }


}