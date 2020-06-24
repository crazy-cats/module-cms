<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Model\Source;

use CrazyCat\Content\Model\Article\Category\Collection as CategoryCollection;

/**
 * @category CrazyCat
 * @package  CrazyCat\Base
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class ArticleCategory extends \CrazyCat\Framework\App\Component\Module\Model\Source\AbstractSource
{
    /**
     * @var \CrazyCat\Framework\Utility\Html
     */
    private $html;

    public function __construct(
        \CrazyCat\Framework\App\ObjectManager $objectManager,
        \CrazyCat\Framework\Utility\Html $html,
        $includeId = null
    ) {
        $this->html = $html;

        /* @var $categoryCollection CategoryCollection */
        $categoryCollection = $objectManager->create(CategoryCollection::class);
        $categoryCollection->addOrder('parent_id')->addOrder('name');

        $categories = [];
        foreach ($categoryCollection as $category) {
            if ($category->getId() == $includeId) {
                continue;
            }
            if (!isset($categories[$category['parent_id']])) {
                $categories[$category['parent_id']] = [];
            }
            $categories[$category['parent_id']][] = $category;
        }

        $this->sourceData = array_merge(['root' => 0], $this->collectChildren($categories, $includeId));
    }

    /**
     * @param array    $categories
     * @param int|null $includeId
     * @param int      $parentId
     * @param int      $level
     * @return array
     */
    private function collectChildren($categories, $includeId = null, $parentId = 0, $level = 0)
    {
        if (!isset($categories[$parentId])) {
            return [];
        }

        $categoryGroup = [];
        foreach ($categories[$parentId] as $category) {
            $label = sprintf(
                '%s%s ( ID: %d )',
                str_repeat($this->html->spaceString(), 4 * $level),
                $category->getData('name'),
                $category->getId()
            );
            $categoryGroup[$label] = $category->getId();

            $children = $this->collectChildren($categories, $includeId, $category->getId(), $level + 1);
            if ($children) {
                $categoryGroup = array_merge($categoryGroup, $children);
            }
        }
        return $categoryGroup;
    }
}
