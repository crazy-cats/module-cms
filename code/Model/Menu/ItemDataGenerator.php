<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Model\Menu;

use CrazyCat\Content\Model\Page\Collection as PageCollection;
use CrazyCat\Framework\Data\DataObject;
use CrazyCat\Framework\Utility\StaticVariable;
use CrazyCat\Menu\Model\Menu\Item as MenuItem;

/**
 * @category CrazyCat
 * @package  CrazyCat\Content
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class ItemDataGenerator extends \CrazyCat\Menu\Model\ItemDataGenerator
{
    /**
     * @param \CrazyCat\Menu\Model\Menu\Item $menuItem
     * @return \CrazyCat\Framework\Data\DataObject[]
     */
    public function generateItems(MenuItem $menuItem)
    {
        $ids = explode(StaticVariable::GENERAL_SEPARATOR, $menuItem->getData('params'));
        $pageCollection = $this->objectManager->create(PageCollection::class)
            ->addFieldToFilter('id', ['in' => $ids])
            ->addFieldToFilter('enabled', ['eq' => 1]);

        $items = [];
        foreach ($pageCollection as $page) {
            $url = $this->url->getUrl('content/page/view', ['id' => $page->getId()]);
            $items[] = new DataObject(
                [
                    'title'      => $page->getData('title'),
                    'url'        => $url,
                    'is_current' => $this->url->isCurrent($url),
                    'level'      => $menuItem->getData('level')
                ]
            );
        }

        return $items;
    }
}
