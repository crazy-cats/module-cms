<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Model;

/**
 * @category CrazyCat
 * @package  CrazyCat\Content
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Article extends \CrazyCat\Base\Model\AbstractLangModel
{
    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function construct()
    {
        $this->init('article', 'article');
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function beforeSave()
    {
        parent::beforeSave();

        if (isset($this->data['stage_ids']) && is_array($this->data['stage_ids'])) {
            $this->data['stage_ids'] = implode(',', $this->data['stage_ids']);
        }
        if (isset($this->data['category_ids']) && is_array($this->data['category_ids'])) {
            $this->data['category_ids'] = implode(',', $this->data['category_ids']);
        }
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function afterLoad()
    {
        if (isset($this->data['stage_ids'])) {
            $this->data['stage_ids'] = explode(',', $this->data['stage_ids']);
        }
        if (isset($this->data['category_ids'])) {
            $this->data['category_ids'] = explode(',', $this->data['category_ids']);
        }

        parent::afterLoad();
    }
}
