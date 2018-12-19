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
        if ( !( $id = $this->request->getParam( 'id' ) ) ) {
            
        }

        /* @var $model \CrazyCat\Cms\Model\Page */
        $model = $this->objectManager->create( Model::class )->load( $id );

        if ( !$model->getId() ) {
            
        }

        $this->registry->register( 'currnet_page', $model );

        $this->setPageTitle( $model->getData( 'title' ) )
                ->setMetaDescription( $model->getData( 'meta_description' ) )
                ->setMetaKeywords( $model->getData( 'meta_keywords' ) )
                ->setMetaRobots( $model->getData( 'meta_robots' ) );

        $this->render();
    }

}
