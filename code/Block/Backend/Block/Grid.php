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
class Grid extends \CrazyCat\Core\Block\Backend\AbstractGrid {

    const BOOKMARK_KEY = 'cms_block';

    /**
     * @return array
     */
    public function getFields()
    {
        return [
                [ 'ids' => true, ],
                [ 'name' => 'id', 'label' => __( 'ID' ), 'sort' => true, 'width' => 100, 'filter' => [ 'type' => 'text', 'condition' => 'eq' ] ],
                [ 'name' => 'title', 'label' => __( 'Block Title' ), 'sort' => true, 'filter' => [ 'type' => 'text', 'condition' => 'like' ] ],
                [ 'name' => 'identifier', 'label' => __( 'Identifier' ), 'sort' => true, 'filter' => [ 'type' => 'text', 'condition' => 'like' ] ],
                [ 'name' => 'enabled', 'label' => __( 'Enabled' ), 'sort' => true, 'width' => 130, 'filter' => [ 'type' => 'select', 'condition' => 'eq' ] ],
                [ 'name' => 'stage_id', 'label' => __( 'View' ), 'sort' => true, 'width' => 130, 'filter' => [ 'type' => 'select', 'condition' => 'eq' ] ],
                [ 'label' => __( 'Actions' ), 'actions' => [
                        [ 'name' => 'edit', 'label' => __( 'Edit' ), 'url' => getUrl( 'cms/block/edit' ) ],
                        [ 'name' => 'delete', 'label' => __( 'Delete' ), 'confirm' => __( 'Sure you want to remove this item?' ), 'url' => getUrl( 'cms/block/delete' ) ]
                ] ] ];
    }

    /**
     * @return string
     */
    public function getSourceUrl()
    {
        return getUrl( 'cms/block/grid' );
    }

}
