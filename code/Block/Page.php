<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Cms\Block;

/**
 * @category CrazyCat
 * @package CrazyCat\Cms
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Page extends \CrazyCat\Framework\App\Module\Block\AbstractBlock {

    protected $template = 'CrazyCat\Cms::page';

    public function getPage()
    {
        return $this->registry->registry( 'currnet_page' );
    }

}
