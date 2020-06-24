<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Block\Backend\ArticleCategory;

use CrazyCat\Base\Model\Source\Stage as SourceStage;
use CrazyCat\Base\Model\Source\YesNo as SourceYesNo;

/**
 * @category CrazyCat
 * @package  CrazyCat\Content
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Grid extends \CrazyCat\Base\Block\Backend\AbstractGrid
{
    public const BOOKMARK_KEY = 'article';

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getFields()
    {
        return [
            ['ids' => true,],
            [
                'name'   => 'id',
                'label'  => __('ID'),
                'sort'   => true,
                'width'  => 100,
                'filter' => ['type' => 'text', 'condition' => 'eq']
            ],
            [
                'name'   => 'name',
                'label'  => __('Category Name'),
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
                'filter' => ['type' => 'select', 'source' => SourceStage::class, 'condition' => 'finset']
            ],
            [
                'name'   => 'enabled',
                'label'  => __('Enabled'),
                'sort'   => true,
                'width'  => 130,
                'filter' => ['type' => 'select', 'source' => SourceYesNo::class, 'condition' => 'eq']
            ],
            [
                'label'   => __('Actions'),
                'actions' => [
                    [
                        'name'  => 'edit',
                        'label' => __('Edit'),
                        'url'   => $this->getUrl('content/article_category/edit')
                    ],
                    [
                        'name'    => 'delete',
                        'label'   => __('Delete'),
                        'confirm' => __('Sure you want to remove this item?'),
                        'url'     => $this->getUrl('content/article_category/delete')
                    ]
                ]
            ]
        ];
    }

    /**
     * @return string
     */
    public function getSourceUrl()
    {
        return $this->getUrl('content/article_category/grid');
    }
}
