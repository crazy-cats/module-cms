<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Model\Article\Category;

use CrazyCat\Content\Model\Article\Collection as ArticleCollection;
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
        $articleCollection = $this->objectManager->create(ArticleCollection::class)
            ->addFieldToFilter('id', ['in' => $ids])
            ->addFieldToFilter('enabled', ['eq' => 1]);

        $items = [];
        foreach ($articleCollection as $article) {
            $url = $this->url->getUrl('content/article_category/view', ['id' => $article->getId()]);
            $items[] = new DataObject(
                [
                    'title'      => $article->getData('title'),
                    'url'        => $url,
                    'is_current' => $this->url->isCurrent($url),
                    'level'      => $menuItem->getData('level')
                ]
            );
        }

        return $items;
    }
}
