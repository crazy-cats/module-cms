<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Cms\Block\Backend\Block;

/**
 * @category CrazyCat
 * @package CrazyCat\Cms
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Edit extends \CrazyCat\Framework\App\Module\Block\Backend\AbstractEdit {

    /**
     * @return array
     */
    public function getFields()
    {
        return [
                [ 'name' => 'id', 'label' => __( 'ID' ), 'type' => 'hidden' ],
                [ 'name' => 'title', 'label' => __( 'Title' ), 'type' => 'text', 'validation' => [ 'required' => true ] ],
                [ 'name' => 'identifier', 'label' => __( 'Identifier' ), 'type' => 'text', 'validation' => [ 'required' => true ] ],
                [ 'name' => 'enabled', 'label' => __( 'Enabled' ), 'type' => 'select', 'options' => [ [ 'value' => '1', 'label' => __( 'Yes' ) ], [ 'value' => '0', 'label' => __( 'No' ) ] ] ],
                [ 'name' => 'view_id', 'label' => __( 'View' ), 'type' => 'select', 'options' => [] ],
                [ 'name' => 'content', 'label' => __( 'Content' ), 'type' => 'textarea' ]
        ];
    }

    /**
     * @return string
     */
    public function getActionUrl()
    {
        return getUrl( 'cms/block/save' );
    }

}
