<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Controller\Backend\Menu;

use CrazyCat\Content\Model\Article\Collection;
use CrazyCat\Base\Model\Source\Stage as SourceStage;
use CrazyCat\Base\Model\Source\YesNo as SourceYesNo;

/**
 * @category CrazyCat
 * @package  CrazyCat\Content
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Articles extends \CrazyCat\Menu\Controller\Backend\ItemType\AbstractGridAction
{
    /**
     * @var \CrazyCat\Content\Model\Article\Collection
     */
    protected $collection;

    /**
     * @var array[]
     */
    protected $fields;

    protected function initCollection()
    {
        $this->collection = $this->objectManager->create(Collection::class);
    }

    protected function initFields()
    {
        $this->fields = [
            [
                'name'   => 'title',
                'label'  => __('Article Title'),
                'sort'   => true,
                'filter' => ['type' => 'text', 'condition' => 'like']
            ],
            [
                'name'   => 'identifier',
                'label'  => __('Identifier'),
                'sort'   => true,
                'filter' => ['type' => 'text', 'condition' => 'like']
            ],
            [
                'name'   => 'stage_ids',
                'label'  => __('Stages'),
                'sort'   => true,
                'width'  => 200,
                'filter' => [
                    'type'      => 'select',
                    'options'   => $this->objectManager->create(SourceStage::class)->toOptionArray(),
                    'condition' => 'finset'
                ]
            ],
            [
                'name'   => 'enabled',
                'label'  => __('Enabled'),
                'sort'   => true,
                'width'  => 130,
                'filter' => [
                    'type'      => 'select',
                    'options'   => $this->objectManager->create(SourceYesNo::class)->toOptionArray(),
                    'condition' => 'eq'
                ]
            ]
        ];
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    protected function processData($collectionData)
    {
        $sourceStage = $this->objectManager->get(SourceStage::class);
        $sourceYesNo = $this->objectManager->get(SourceYesNo::class);

        foreach ($collectionData['items'] as &$item) {
            $item['enabled'] = $sourceYesNo->getLabel($item['enabled']);
            $item['stage_ids'] = $sourceStage->getLabel($item['stage_ids']);
        }

        return $collectionData;
    }
}
