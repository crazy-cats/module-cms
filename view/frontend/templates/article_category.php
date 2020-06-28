<?php
/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

/* @var $this \CrazyCat\Content\Block\Article\Category */
$category = $this->getCategory();
?>
<div class="block block-article-category">
    <div class="block-title">
        <h1><?= $category->getData('name'); ?></h1>
    </div>
    <div class="block-content">
        <div class="description">
            <?= $category->getData('description'); ?>
        </div>
        <?= $this->getSectionHtml('article_list'); ?>
    </div>
</div>