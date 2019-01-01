<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Cms\Controller\Backend\Menu;

use CrazyCat\Cms\Model\Page\Collection;
use CrazyCat\Core\Model\Source\Stage as SourceStage;
use CrazyCat\Core\Model\Source\YesNo as SourceYesNo;

/**
 * @category CrazyCat
 * @package CrazyCat\Cms
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Pages extends \CrazyCat\Menu\Controller\Backend\ItemType\AbstractGridAction {

    protected function initCollection()
    {
        $this->collection = $this->objectManager->create( Collection::class );
    }

    protected function initFields()
    {
        $this->fields = [
                [ 'name' => 'title', 'label' => __( 'Page Title' ), 'sort' => true, 'filter' => [ 'type' => 'text', 'condition' => 'like' ] ],
                [ 'name' => 'identifier', 'label' => __( 'Identifier' ), 'sort' => true, 'filter' => [ 'type' => 'text', 'condition' => 'like' ] ],
                [ 'name' => 'stage_ids', 'label' => __( 'Stages' ), 'sort' => true, 'width' => 200, 'filter' => [ 'type' => 'select', 'options' => $this->objectManager->create( SourceStage::class )->toOptionArray(), 'condition' => 'finset' ] ],
                [ 'name' => 'enabled', 'label' => __( 'Enabled' ), 'sort' => true, 'width' => 130, 'filter' => [ 'type' => 'select', 'options' => $this->objectManager->create( SourceYesNo::class )->toOptionArray(), 'condition' => 'eq' ] ]
        ];
    }

    protected function processData( $collectionData )
    {
        $sourceStage = $this->objectManager->get( SourceStage::class );
        $sourceYesNo = $this->objectManager->get( SourceYesNo::class );

        foreach ( $collectionData['items'] as &$item ) {
            $item['enabled'] = $sourceYesNo->getLabel( $item['enabled'] );
            $item['stage_ids'] = $sourceStage->getLabel( $item['stage_ids'] );
        }

        return $collectionData;
    }

}
