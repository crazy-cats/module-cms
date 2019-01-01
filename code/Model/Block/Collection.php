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
class Collection extends \CrazyCat\Framework\App\Module\Model\AbstractLangCollection {

    protected function construct()
    {
        $this->init( 'CrazyCat\Cms\Model\Block' );
    }

    /**
     * @return void
     */
    protected function beforeLoad()
    {
        if ( $this->objectManager->get( Area::class )->getCode() === Area::CODE_FRONTEND ) {
            $stage = $this->objectManager->get( StageManager::class )->getCurrentStage();
            $this->addFieldToFilter( [
                    [ 'field' => 'stage_ids', 'conditions' => [ 'finset' => $stage->getId() ] ],
                    [ 'field' => 'stage_ids', 'conditions' => [ 'finset' => 0 ] ]
            ] );
        }

        parent::beforeLoad();
    }

    /**
     * @return void
     */
    protected function afterLoad()
    {
        parent::afterLoad();

        foreach ( $this->items as &$item ) {
            $item->setData( 'stage_ids', explode( ',', $item->getData( 'stage_ids' ) ) );
        }
    }

}
