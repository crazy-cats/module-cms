<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Observer;

use CrazyCat\Framework\App\Io\Http\Url;

/**
 * @category CrazyCat
 * @package  CrazyCat\Content
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class UpdateArticleCategoryUrlRewrites
{
    /**
     * @var \CrazyCat\Framework\App\Db\MySql
     */
    protected $conn;

    public function __construct(
        \CrazyCat\Framework\App\Db\Manager $dbManager
    ) {
        $this->conn = $dbManager->getConnection('default');
    }

    /**
     * @param \CrazyCat\Content\Model\Article\Category
     * @return string
     * @throws \Exception
     */
    private function getParentPath($model)
    {
        if (!$model->getData('parent_id')) {
            return '';
        }

        $sql = sprintf(
            'SELECT `path` FROM `%s` WHERE `id` = ?',
            $this->conn->getTableName('article_category')
        );
        $parentPath = $this->conn->fetchOne($sql, [$model->getData('parent_id')]);
        $allCategoryIds = explode('/', $parentPath);

        $sql = sprintf(
            'SELECT `id`, `identifier` FROM `%s` WHERE `id` IN (%s)',
            $this->conn->getTableName('article_category'),
            implode(',', array_fill(0, count($allCategoryIds), '?'))
        );
        $identifiers = $this->conn->fetchPairs($sql, $allCategoryIds);

        return implode(
                '/',
                array_map(
                    function ($id) use ($identifiers) {
                        return $identifiers[$id];
                    },
                    explode('/', $parentPath)
                )
            ) . '/';
    }

    /**
     * @param array $data
     * @throws \ReflectionException
     */
    private function checkDuplicatedRewrites($data)
    {
        $newRequestPaths = [];
        foreach ($data as $rewrite) {
            $newRequestPaths[] = $rewrite['request_path'];
        }
        $sql = sprintf(
            'SELECT `request_path` FROM `%s` ' .
            'WHERE `target_path` != \'content/article_category/view\' AND `request_path` IN (%s)',
            $this->conn->getTableName('url_rewrite'),
            implode(',', array_fill(0, count($newRequestPaths), '?'))
        );
        $existRequestPaths = $this->conn->fetchCol($sql, $newRequestPaths);
        if (count($existRequestPaths)) {
            throw new \Exception(
                __(
                    'URL rewrite record with this request path already exists: %1.',
                    [implode(', ', $existRequestPaths)]
                )
            );
        }
    }

    /**
     * @param $observer
     * @return void
     * @throws \Exception
     */
    public function execute($observer)
    {
        $model = $observer->getData('model');
        if (!$model->getData('enabled')) {
            return;
        }
        if (!$model->hasData('stage_ids')) {
            return;
        }

        $data = [];
        $stageIds = explode(',', $model->getData('stage_ids'));
        foreach ($stageIds as $stageId) {
            $data[] = [
                'stage_id'     => $stageId,
                'request_path' => $this->getParentPath($model) . $model->getData('identifier'),
                'target_path'  => 'content/article_category/view',
                'entity_id'    => $model->getId(),
                'params'       => json_encode([Url::ID_NAME => $model->getId()])
            ];
        }

        $this->checkDuplicatedRewrites($data);

        $this->conn->insertUpdate(
            $this->conn->getTableName('url_rewrite'),
            $data,
            ['target_path', 'entity_id', 'params']
        );
    }
}