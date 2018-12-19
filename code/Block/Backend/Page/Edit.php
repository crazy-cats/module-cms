<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Cms\Block\Backend\Page;

use CrazyCat\Core\Model\Source\MetaRobots as SourceMetaRobots;
use CrazyCat\Core\Model\Source\Stage as SourceStage;
use CrazyCat\Core\Model\Source\YesNo as SourceYesNo;

/**
 * @category CrazyCat
 * @package CrazyCat\Cms
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Edit extends \CrazyCat\Core\Block\Backend\AbstractEdit {

    /**
     * @return array
     */
    public function getFields()
    {
        return [
            'general' => [
                'label' => __( 'General' ),
                'fields' => [
                        [ 'name' => 'id', 'label' => __( 'ID' ), 'type' => 'hidden' ],
                        [ 'name' => 'title', 'label' => __( 'Title' ), 'type' => 'text', 'validation' => [ 'required' => true ] ],
                        [ 'name' => 'identifier', 'label' => __( 'Identifier' ), 'type' => 'text', 'validation' => [ 'required' => true ] ],
                        [ 'name' => 'enabled', 'label' => __( 'Enabled' ), 'type' => 'select', 'source' => SourceYesNo::class ],
                        [ 'name' => 'stage_ids', 'label' => __( 'Stage' ), 'type' => 'multiselect', 'source' => SourceStage::class ],
                        [ 'name' => 'content', 'label' => __( 'Content' ), 'type' => 'editor' ],
                        [ 'name' => 'sort_order', 'label' => __( 'Sort Order' ), 'type' => 'text', 'default_value' => 0, 'validation' => [ 'digits' => true ] ]
                ]
            ],
            'seo' => [
                'label' => __( 'SEO' ),
                'fields' => [
                        [ 'name' => 'meta_keywords', 'label' => __( 'Meta Keywords' ), 'type' => 'text' ],
                        [ 'name' => 'meta_description', 'label' => __( 'Meta Description' ), 'type' => 'textarea' ],
                        [ 'name' => 'meta_robots', 'label' => __( 'Meta Robots' ), 'type' => 'select', 'source' => SourceMetaRobots::class ]
                ]
            ],
            'design' => [
                'label' => __( 'Design' ),
                'fields' => [
                        [ 'name' => 'layout', 'label' => __( 'Layout' ), 'type' => 'textarea' ]
                ]
            ]
        ];
    }

    /**
     * @return string
     */
    public function getActionUrl()
    {
        return getUrl( 'cms/page/save' );
    }

}
