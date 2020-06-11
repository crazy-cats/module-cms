<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Controller\Backend\Page;

use CrazyCat\Content\Model\Page as Model;

/**
 * @category CrazyCat
 * @package  CrazyCat\Content
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Edit extends \CrazyCat\Framework\App\Component\Module\Controller\Backend\AbstractAction
{
    protected function execute()
    {
        /* @var $model \CrazyCat\Base\Model\AbstractLangModel */
        $model = $this->objectManager->create(Model::class);

        if (($id = $this->request->getParam('id'))) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messenger->addError(__('Item with specified ID does not exist.'));
                return $this->redirect('content/block');
            }
        }

        $this->registry->register('current_model', $model);

        $pageTitle = $model->getId() ?
            __('Edit Content Page `%1` [ ID: %2 ]', [$model->getData('title'), $model->getId()]) :
            __('Create Content Page');

        $this->setPageTitle($pageTitle)->render();
    }
}
