<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

/**
 * @category CrazyCat
 * @package  CrazyCat\Content
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
return [
    'content' => [
        'label'      => 'Contents',
        'sort_order' => 100,
        'children'   => [
            'content/block/index'            => [
                'label' => 'Blocks',
                'url'   => 'content/block'
            ],
            'content/article/index'          => [
                'label' => 'Articles',
                'url'   => 'content/article'
            ],
            'content/article_category/index' => [
                'label' => 'Article Categories',
                'url'   => 'content/article_category'
            ]
        ]
    ]
];
