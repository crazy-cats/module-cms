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
class Block extends \CrazyCat\Framework\App\Module\Model\AbstractModel {

    /**
     * @return void
     */
    protected function construct()
    {
        $this->init( 'cms_block', 'cms_block' );
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
    }

}
