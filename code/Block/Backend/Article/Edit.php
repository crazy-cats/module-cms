<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Block\Backend\Article;

use CrazyCat\Base\Model\Source\MetaRobots as SourceMetaRobots;
use CrazyCat\Base\Model\Source\Stage as SourceStage;
use CrazyCat\Base\Model\Source\YesNo as SourceYesNo;
use CrazyCat\Content\Model\Source\ArticleCategory as SourceCategory;

/**
 * @category CrazyCat
 * @package  CrazyCat\Content
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Edit extends \CrazyCat\Base\Block\Backend\AbstractEdit
{
    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getFields()
    {
        return [
            'general' => [
                'label'  => __('General'),
                'fields' => [
                    [
                        'name'  => 'id',
                        'label' => __('ID'),
                        'type'  => 'hidden'
                    ],
                    [
                        'name'       => 'title',
                        'label'      => __('Title'),
                        'type'       => 'text',
                        'validation' => ['required' => true]
                    ],
                    [
                        'name'       => 'identifier',
                        'label'      => __('Identifier'),
                        'type'       => 'text',
                        'validation' => ['required' => true]
                    ],
                    [
                        'name'   => 'enabled',
                        'label'  => __('Enabled'),
                        'type'   => 'select',
                        'source' => SourceYesNo::class
                    ],
                    [
                        'name'   => 'stage_ids',
                        'label'  => __('Stage'),
                        'type'   => 'multiselect',
                        'source' => SourceStage::class
                    ],
                    [
                        'name'   => 'category_ids',
                        'label'  => __('Categories'),
                        'type'   => 'multiselect',
                        'source' => SourceCategory::class
                    ],
                    [
                        'name'   => 'short_content',
                        'label'  => __('Short Content'),
                        'type'   => 'editor',
                        'height' => 200
                    ],
                    [
                        'name'  => 'content',
                        'label' => __('Content'),
                        'type'  => 'editor'
                    ],
                    [
                        'name'          => 'sort_order',
                        'label'         => __('Sort Order'),
                        'type'          => 'text',
                        'default_value' => 0,
                        'validation'    => ['digits' => true]
                    ]
                ]
            ],
            'seo'     => [
                'label'  => __('SEO'),
                'fields' => [
                    [
                        'name'  => 'meta_keywords',
                        'label' => __('Meta Keywords'),
                        'type'  => 'text'
                    ],
                    [
                        'name'  => 'meta_description',
                        'label' => __('Meta Description'),
                        'type'  => 'textarea'
                    ],
                    [
                        'name'   => 'meta_robots',
                        'label'  => __('Robots'),
                        'type'   => 'select',
                        'source' => SourceMetaRobots::class
                    ]
                ]
            ],
            'design'  => [
                'label'  => __('Design'),
                'fields' => [
                    [
                        'name'  => 'layout',
                        'label' => __('Layout'),
                        'type'  => 'textarea'
                    ]
                ]
            ]
        ];
    }

    /**
     * @return string
     */
    public function getActionUrl()
    {
        return $this->getUrl('content/article/save');
    }
}
