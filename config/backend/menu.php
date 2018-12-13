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
        [
        'label' => __( 'CMS' ), 'identifier' => 'cms',
        'children' => [
                [ 'label' => __( 'CMS Blocks' ), 'identifier' => 'cms/block/index', 'url' => getUrl( 'cms/block' ) ],
                [ 'label' => __( 'CMS Pages' ), 'identifier' => 'cms/page/index', 'url' => getUrl( 'cms/page' ) ]
        ],
        'sort_order' => 1 ]
];
