<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Cms\Model;

/**
 * @category CrazyCat
 * @package CrazyCat\Cms
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Page extends \CrazyCat\Framework\App\Module\Model\AbstractModel {

    /**
     * @return void
     */
    protected function construct()
    {
        $this->init( 'cms_page', 'cms_page' );
    }

    /**
     * @return void
     */
    protected function beforeSave()
    {
        parent::beforeSave();

        $now = date( 'Y-m-d H:i:s' );
        $this->setData( 'updated_at', $now );
        if ( !$this->getId() ) {
            $this->setData( 'created_at', $now );
        }

        if ( isset( $this->data['stage_ids'] ) && is_array( $this->data['stage_ids'] ) ) {
            $this->data['stage_ids'] = implode( ',', $this->data['stage_ids'] );
        }
    }

    /**
     * @return void
     */
    protected function afterLoad()
    {
        $this->data['stage_ids'] = explode( ',', $this->data['stage_ids'] );

        parent::afterLoad();
    }

}
