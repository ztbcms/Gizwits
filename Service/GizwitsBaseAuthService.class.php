<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Gizwits\Service;

use Gizwits\Entity\GizwitsConfig;

class GizwitsBaseAuthService extends GizwitsBaseService {

    /**
     * GizwitsBaseAuthService constructor.
     *
     * @param GizwitsConfig $gizwitsConfig
     */
    public function __construct(GizwitsConfig $gizwitsConfig) {
        parent::__construct($gizwitsConfig);
    }
}