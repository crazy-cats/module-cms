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
    'article_category' => [
        'label'                 => 'Article Category',
        'params_generating_url' => 'content/menu/article_categories',
        'item_data_generator'   => 'CrazyCat\Content\Model\Article\Category\ItemDataGenerator'
    ]
];
