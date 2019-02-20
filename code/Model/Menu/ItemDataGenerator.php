<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Cms\Model\Menu;

use CrazyCat\Cms\Model\Page\Collection as PageCollection;
use CrazyCat\Framework\Data\Object as DataObject;
use CrazyCat\Framework\Utility\StaticVariable;
use CrazyCat\Menu\Model\Menu\Item as MenuItem;

/**
 * @category CrazyCat
 * @package CrazyCat\Cms
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class ItemDataGenerator extends \CrazyCat\Menu\Model\ItemDataGenerator {

    /**
     * @param \CrazyCat\Menu\Model\Menu\Item $menuItem
     * @return \CrazyCat\Framework\Data\Object[]
     */
    public function generateItems( MenuItem $menuItem )
    {
        $ids = explode( StaticVariable::GENERAL_SEPARATOR, $menuItem->getData( 'params' ) );
        $pageCollection = $this->objectManager->create( PageCollection::class )
                ->addFieldToFilter( 'id', [ 'in' => $ids ] )
                ->addFieldToFilter( 'enabled', [ 'eq' => 1 ] );

        $items = [];
        foreach ( $pageCollection as $page ) {
            $url = $this->url->getUrl( 'cms/page/view', [ 'id' => $page->getId() ] );
            $items[] = new DataObject( [
                'title' => $page->getData( 'title' ),
                'url' => $url,
                'is_current' => $this->url->isCurrent( $url ),
                'level' => $menuItem->getData( 'level' ) ] );
        }

        return $items;
    }

}
