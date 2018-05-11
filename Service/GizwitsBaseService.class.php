<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Gizwits\Service;

use Gizwits\Entity\GizwitsConfig;
use System\Service\BaseService;

class GizwitsBaseService extends BaseService {

    /**
     * @var GizwitsConfig
     */
    private $gizwitsConfig;

    /**
     * GizwitsBaseService constructor.
     *
     * @param GizwitsConfig $gizwitsConfig
     */
    public function __construct(GizwitsConfig $gizwitsConfig) {
      $this->gizwitsConfig = $gizwitsConfig;
    }

    /**
     * @param $timestamp
     * @return string
     */
    function signature($timestamp) {
        return strtolower(md5($this->gizwitsConfig->getProductSecret() . $timestamp));
    }

    /**
     * 检测statusCode 是否为OK
     *
     * @param $statusCode
     * @return bool
     */
    static function isOk($statusCode) {
        if ($statusCode >= 200 && $statusCode <= 300) {
            return true;
        }
    }

    /**
     * @return GizwitsConfig
     */
    public function getGizwitsConfig() {
        return $this->gizwitsConfig;
    }

    /**
     * @param GizwitsConfig $gizwitsConfig
     */
    public function setGizwitsConfig($gizwitsConfig) {
        $this->gizwitsConfig = $gizwitsConfig;
    }
}