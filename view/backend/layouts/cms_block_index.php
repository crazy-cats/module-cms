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
    'template' => '2columns_left',
    'blocks' => [
        'header' => [
                [ 'class' => 'CrazyCat\Index\Block\Template', 'data' => [
                    'template' => 'CrazyCat\Index::header_buttons',
                    'buttons' => [
                        'delete' => [ 'label' => __( 'Mass Delete' ), 'action' => [ 'type' => 'massDelete', 'confirm' => __( 'Sure you want to remove selected item(s)?' ), 'params' => [ 'target' => '#grid-form', 'action' => getUrl( 'cms/block/massdelete' ) ] ] ],
                        'new' => [ 'label' => __( 'Create New' ), 'action' => [ 'type' => 'redirect', 'params' => [ 'url' => getUrl( 'cms/block/edit' ) ] ] ]
                    ]
                ] ]
        ],
        'main' => [
                [ 'class' => 'CrazyCat\Cms\Block\Backend\Block\Grid' ]
        ]
    ]
];
