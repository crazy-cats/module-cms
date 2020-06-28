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
class UpdateArticleUrlRewrites
{
    /**
     * @var \CrazyCat\Framework\App\Db\AbstractAdapter
     */
    protected $conn;

    public function __construct(
        \CrazyCat\Framework\App\Db\Manager $dbManager
    ) {
        $this->conn = $dbManager->getConnection('default');
    }

    /**
     * @param $model
     * @return array
     */
    private function collectOrgRewrites($model)
    {
        $orgUrlRewriteData = [];
        $sql = sprintf(
            'SELECT * FROM `%s` WHERE `target_path` = ? AND `entity_id` = ?',
            $this->conn->getTableName('url_rewrite')
        );
        $urlRewrites = $this->conn->fetchAll($sql, ['content/article/view', $model->getId()]);
        foreach ($urlRewrites as $urlRewrite) {
            $orgUrlRewriteData[$urlRewrite['stage_id'] . '-' . $urlRewrite['request_path']] = $urlRewrite;
        }
        return $orgUrlRewriteData;
    }

    /**
     * @param $model
     * @return array
     */
    private function collectNewRewrites($model)
    {
        $newUrlRewriteData = [];
        $stageIds = explode(',', $model->getData('stage_ids'));
        foreach ($stageIds as $stageId) {
            $newUrlRewriteData[$stageId . '-' . $model->getData('identifier') . '.html'] = [
                'stage_id'     => $stageId,
                'request_path' => $model->getData('identifier') . '.html',
                'target_path'  => 'content/article/view',
                'entity_id'    => $model->getId(),
                'params'       => json_encode([Url::ID_NAME => $model->getId()])
            ];
        }
        if ($model->hasData('category_ids')) {
            $categoryIds = explode(',', $model->getData('category_ids'));
        }
        if (!empty($categoryIds)) {
            $sql = sprintf(
                'SELECT `id`, `path` FROM `%s` WHERE `enabled` = 1 AND `id` IN (%s)',
                $this->conn->getTableName('article_category'),
                implode(',', array_fill(0, count($categoryIds), '?'))
            );
            $categoryPaths = $this->conn->fetchPairs($sql, $categoryIds);

            $allCategoryIds = [];
            foreach ($categoryPaths as $path) {
                $allCategoryIds = array_merge($allCategoryIds, explode('/', $path));
            }
            $allCategoryIds = array_unique($allCategoryIds);

            $sql = sprintf(
                'SELECT `id`, `identifier` FROM `%s` WHERE `id` IN (%s)',
                $this->conn->getTableName('article_category'),
                implode(',', array_fill(0, count($allCategoryIds), '?'))
            );
            $identifiers = $this->conn->fetchPairs($sql, $allCategoryIds);

            foreach ($categoryPaths as $categoryId => $categoryPath) {
                $requestPath = implode(
                        '/',
                        array_map(
                            function ($id) use ($identifiers) {
                                return $identifiers[$id];
                            },
                            explode('/', $categoryPath)
                        )
                    ) . '/' . $model->getData('identifier') . '.html';
                foreach ($stageIds as $stageId) {
                    $newUrlRewriteData[$stageId . '-' . $requestPath] = [
                        'stage_id'     => $stageId,
                        'request_path' => $requestPath,
                        'target_path'  => 'content/article/view',
                        'entity_id'    => $model->getId(),
                        'params'       => json_encode(['cid' => $categoryId, Url::ID_NAME => $model->getId()])
                    ];
                }
            }
        }
        return $newUrlRewriteData;
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
            'WHERE `target_path` != \'content/article/view\' AND `request_path` IN (%s)',
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

        $orgUrlRewriteData = $this->collectOrgRewrites($model);
        $newUrlRewriteData = $this->collectNewRewrites($model);

        $this->checkDuplicatedRewrites($newUrlRewriteData);

        $toRemoveData = array_diff_key($orgUrlRewriteData, $newUrlRewriteData);
        $toAddData = array_diff_key($newUrlRewriteData, $orgUrlRewriteData);
        $toUpdateData = array_intersect_key($orgUrlRewriteData, $newUrlRewriteData);

        $tblUrlRewrite = $this->conn->getTableName('url_rewrite');
        if (!empty($toRemoveData)) {
            $toRemoveUrlRewriteIds = [];
            foreach ($toRemoveData as $data) {
                $toRemoveUrlRewriteIds[] = $data['id'];
            }
        }
        if (!empty($toAddData)) {
            $this->conn->insertArray($tblUrlRewrite, $toAddData);
        }
        if (!empty($toUpdateData)) {
            foreach ($toUpdateData as $key => $data) {
                $this->conn->update($tblUrlRewrite, $newUrlRewriteData[$key], ['id = ?' => $data['id']]);
            }
        }
    }
}