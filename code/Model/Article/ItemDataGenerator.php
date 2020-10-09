<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Model\Article;

use CrazyCat\Content\Model\Article\Collection as CategoryCollection;
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
     * @throws \ReflectionException
     */
    public function generateItems(MenuItem $menuItem)
    {
        $ids = explode(StaticVariable::GENERAL_SEPARATOR, $menuItem->getData('params'));
        $collection = $this->objectManager->create(CategoryCollection::class)
            ->addFieldToFilter('id', ['in' => $ids])
            ->addFieldToFilter('enabled', ['eq' => 1]);

        $items = [];
        foreach ($collection as $item) {
            $url = $this->url->getUrl('content/article/view', ['id' => $item->getId()]);
            $items[] = new DataObject(
                [
                    'title'      => $item->getData('title'),
                    'url'        => $url,
                    'is_current' => $this->url->isCurrent($url),
                    'level'      => $menuItem->getData('level')
                ]
            );
        }

        return $items;
    }
}
