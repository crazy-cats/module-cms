<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Controller\Frontend\Page;

use CrazyCat\Content\Model\Page as Model;

/**
 * @category CrazyCat
 * @package  CrazyCat\Content
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class View extends \CrazyCat\Framework\App\Component\Module\Controller\Frontend\AbstractAction
{
    /**
     * @return void
     * @throws \ReflectionException
     * @throws \Exception
     */
    protected function execute()
    {
        if (!($id = $this->request->getParam('id'))) {
        }

        /* @var $model \CrazyCat\Content\Model\Page */
        $model = $this->objectManager->create(Model::class)->load($id);

        if (!$model->getId()) {
        }

        $this->registry->register('current_page', $model);

        $this->setPageTitle($model->getData('title'))
            ->setMetaDescription($model->getData('meta_description'))
            ->setMetaKeywords($model->getData('meta_keywords'))
            ->setMetaRobots($model->getData('meta_robots'));

        $this->render();
    }
}
