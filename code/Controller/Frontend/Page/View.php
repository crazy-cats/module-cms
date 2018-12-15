<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Cms\Controller\Frontend\Page;

use CrazyCat\Cms\Model\Page as Model;

/**
 * @category CrazyCat
 * @package CrazyCat\Cms
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class View extends \CrazyCat\Framework\App\Module\Controller\Frontend\AbstractAction {

    protected function run()
    {
        $id = $this->request->getParam( 'id' );
        $model = $this->objectManager->create( Model::class )->load( $id );
        $this->registry->register( 'currnet_page', $model );
        $this->render();
    }

}
