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
    'template' => '1column',
    'blocks'   => [
        'main'         => [
            'category' => ['class' => 'CrazyCat\Content\Block\Article\Category']
        ],
        'article_list' => [
            'articles' => ['class' => 'CrazyCat\Content\Block\Article\Grid']
        ]
    ]
];
