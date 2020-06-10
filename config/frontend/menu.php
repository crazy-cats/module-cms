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
        'label'                 => 'Contents',
        'params_generating_url' => 'content/menu/pages',
        'item_data_generator'   => 'CrazyCat\Content\Model\Menu\ItemDataGenerator'
    ]
];
