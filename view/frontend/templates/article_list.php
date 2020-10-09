<?php
/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

/* @var $this \CrazyCat\Content\Block\Article\Grid */
$articles = $this->getArticles();
?>
<div class="articles">
    <?php if ($articles): ?>
        <?php foreach ($articles as $article) : ?>
            <div class="article">
                <h3><?= $article->getData('title'); ?></h3>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-item">
            <?= __('No matched item found.') ?>
        </div>
    <?php endif; ?>
</div>