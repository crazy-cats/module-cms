<?php
/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

/* @var $this \CrazyCat\Content\Block\Article */
$article = $this->getArticle();
?>
<div class="block block-article">
    <div class="block-title">
        <h1><?= $article->getData('title'); ?></h1>
    </div>
    <div class="block-content">
        <?= $article->getData('content'); ?>
    </div>
</div>