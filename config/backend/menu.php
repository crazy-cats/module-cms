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
            'content/block/index' => [
                'label' => 'Content Blocks',
                'url'   => 'content/block'
            ],
            'content/page/index'  => [
                'label' => 'Content Pages',
                'url'   => 'content/page'
            ]
        ]
    ]
];
