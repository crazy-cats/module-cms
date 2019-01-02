<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

/**
 * @category CrazyCat
 * @package CrazyCat\Menu
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
return [
    'cms' => [
        'label' => 'CMS',
        'params_generating_url' => 'cms/menu/pages',
        'item_data_generator' => 'CrazyCat\Cms\Model\Menu\ItemDataGenerator'
    ]
];
