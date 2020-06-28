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
     * @param $observer
     * @return void
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

        $orgUrlRewriteData = [];
        $stageIds = explode(',', $model->getData('stage_ids'));
        $tblUrlRewrite = $this->conn->getTableName('url_rewrite');
        $sql = sprintf(
            'SELECT * FROM `%s` WHERE `target_path` = ? AND `entity_id` = ?',
            $tblUrlRewrite
        );
        $urlRewrites = $this->conn->fetchAll($sql, ['content/article/view', $model->getId()]);
        foreach ($urlRewrites as $urlRewrite) {
            $orgUrlRewriteData[$urlRewrite['stage_id'] . '-' . $urlRewrite['request_path']] = $urlRewrite;
        }

        $newUrlRewriteData = [];
        foreach ($stageIds as $stageId) {
            $newUrlRewriteData[$stageId . '-' . $model->getData('identifier')] = [
                'stage_id'     => $stageId,
                'request_path' => $model->getData('identifier'),
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
                    ) . '/' . $model->getData('identifier');
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

        $toRemoveData = array_diff_key($orgUrlRewriteData, $newUrlRewriteData);
        $toAddData = array_diff_key($newUrlRewriteData, $orgUrlRewriteData);
        $toUpdateData = array_intersect_key($orgUrlRewriteData, $newUrlRewriteData);

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
            foreach ($toUpdateData as $data) {
                $this->conn->update($tblUrlRewrite, $data, ['id = ?' => $data['id']]);
            }
        }
    }
}