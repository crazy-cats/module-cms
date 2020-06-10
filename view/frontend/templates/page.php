<?php
/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

/* @var $this \CrazyCat\Content\Block\Page */
$page = $this->getPage();
?>
<div class="block block-content-page">
    <div class="block-title">
        <h1><?= $page->getData('title'); ?></h1>
    </div>
    <div class="block-content">
        <?= $page->getData('content'); ?>
    </div>
</div>