<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

/**
 * @category CrazyCat
 * @package CrazyCat\Cms
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
return [
    'cms' => [
        'label' => __( 'CMS' ),
        'sort_order' => 100,
        'children' => [
            'cms/block/index' => [
                'label' => __( 'CMS Blocks' ),
                'url' => getUrl( 'cms/block' )
            ],
            'cms/page/index' => [
                'label' => __( 'CMS Pages' ),
                'url' => getUrl( 'cms/page' )
            ]
        ]
    ]
];
