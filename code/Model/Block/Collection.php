<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Cms\Model\Block;

use CrazyCat\Core\Model\Stage\Manager as StageManager;
use CrazyCat\Framework\App\Area;

/**
 * @category CrazyCat
 * @package CrazyCat\Cms
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Collection extends \CrazyCat\Framework\App\Module\Model\AbstractCollection {

    protected function construct()
    {
        $this->init( 'CrazyCat\Cms\Model\Block' );
    }

    protected function beforeLoad()
    {
        if ( $this->objectManager->get( Area::class )->getCode() === Area::CODE_FRONTEND ) {
            $stage = $this->objectManager->get( StageManager::class )->getCurrentStage();
            $this->addFieldToFilter( 'stage_id', [ 'finset' => $stage->getId() ] );
        }
        parent::beforeLoad();
    }

}
