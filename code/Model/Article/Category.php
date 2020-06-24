<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Model\Article;

/**
 * @category CrazyCat
 * @package  CrazyCat\Content
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Category extends \CrazyCat\Base\Model\AbstractLangModel
{
    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function construct()
    {
        $this->init('article_category', 'article_category');
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

        if (!$this->isNew) {
            $path = '';
            if ($this->getData('parent_id')) {
                $sql = sprintf(
                    'SELECT `path` FROM %s WHERE `id` = ?',
                    $this->conn->getTableName($this->getMainTable())
                );
                $path = $this->conn->fetchOne($sql, [$this->getData('parent_id')]);
            }
            $this->setData('path', ($path ? ($path . '/') : '') . $this->getId());
        }
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function afterSave()
    {
        parent::afterSave();

        if ($this->isNew === true) {
            $this->isNew = false;
            $sql = sprintf('SELECT `path` FROM %s WHERE `id` = ?', $this->conn->getTableName($this->getMainTable()));
            $path = $this->conn->fetchOne($sql, [$this->getData('parent_id')]);
            $this->setData('path', ($path ? ($path . '/') : '') . $this->getId())->save();
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

        parent::afterLoad();
    }
}
