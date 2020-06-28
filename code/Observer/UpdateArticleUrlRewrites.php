<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Observer;

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
        $modArticle = $observer->getData('model');

        if (!$modArticle->getData('enabled')) {
            return;
        }

        if (!$modArticle->hasData('stage_ids')) {
            return;
        }
        $stageIds = explode(',', $modArticle->getData('stage_ids'));


        $orgUrlRewriteData = [];
        $tblUrlRewrite = $this->conn->getTableName('url_rewrite');
        $sql = sprintf(
            'SELECT * FROM `%s` WHERE `target_path` = ? AND `entity_id` = ?',
            $tblUrlRewrite
        );
        $urlRewrites = $this->conn->fetchAll($sql, ['content/article/view', $modArticle->getId()]);
        foreach ($urlRewrites as $urlRewrite) {
            $orgUrlRewriteData[$urlRewrite['stage_id'] . '-' . $urlRewrite['request_path']] = $urlRewrite;
        }

        $newUrlRewriteData = [];
        foreach ($stageIds as $stageId) {
            $newUrlRewriteData[$stageId . '-' . $modArticle->getData('identifier')] = [
                'stage_id'     => $stageId,
                'request_path' => $modArticle->getData('identifier'),
                'target_path'  => 'content/article/view',
                'entity_id'    => $modArticle->getId(),
                'params'       => null
            ];
        }
        if ($modArticle->hasData('category_ids')) {
            $categoryIds = explode(',', $modArticle->getData('category_ids'));
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
                    ) . '/' . $modArticle->getData('identifier');
                foreach ($stageIds as $stageId) {
                    $newUrlRewriteData[$stageId . '-' . $requestPath] = [
                        'stage_id'     => $stageId,
                        'request_path' => $requestPath,
                        'target_path'  => 'content/article/view',
                        'entity_id'    => $modArticle->getId(),
                        'params'       => json_encode(['cid' => $categoryId])
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