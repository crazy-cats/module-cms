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
        'main' => [
            'children' => [
                'article' => ['class' => 'CrazyCat\Content\Block\Article']
            ]
        ]
    ]
];
