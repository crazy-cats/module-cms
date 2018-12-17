<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Cms\Controller\Backend\Block;

use CrazyCat\Cms\Block\Backend\Block\Grid as GridBlock;
use CrazyCat\Cms\Model\Block\Collection;
use CrazyCat\Core\Model\Source\Stage as SourceStage;
use CrazyCat\Core\Model\Source\YesNo as SourceYesNo;

/**
 * @category CrazyCat
 * @package CrazyCat\Cms
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Grid extends \CrazyCat\Core\Controller\Backend\AbstractGridAction {

    protected function construct()
    {
        $this->init( Collection::class, GridBlock::class );
    }

    /**
     * @param array $collectionData
     * @return array
     */
    protected function processData( $collectionData )
    {
        $sourceStage = $this->objectManager->get( SourceStage::class );
        $sourceYesNo = $this->objectManager->get( SourceYesNo::class );
        foreach ( $collectionData['items'] as &$item ) {
            $item['enabled'] = $sourceYesNo->getLabel( $item['enabled'] );
            $item['stage_id'] = $sourceStage->getLabel( $item['stage_id'] );
        }
        return $collectionData;
    }

}
