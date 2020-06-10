<?php
/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

/* @var $this \CrazyCat\Content\Block\Block */
$block = $this->getBlock();
?>
<div class="block block-content-block">
    <?php if (!$this->getHideTitle()) : ?>
        <div class="block-title">
            <h1><?= $block->getData('title'); ?></h1>
        </div>
    <?php endif; ?>
    <div class="block-content">
        <?= $block->getData('content'); ?>
    </div>
</div>