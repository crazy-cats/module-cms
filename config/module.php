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
    'namespace' => 'CrazyCat\Content',
    'depends'   => [
        'CrazyCat\Base',
        'CrazyCat\UrlRewrite'
    ],
    'routes'    => [
        'frontend' => 'content',
        'backend'  => 'content'
    ],
    'setup'     => [
        'CrazyCat\Content\Setup\Install'
    ]
];
