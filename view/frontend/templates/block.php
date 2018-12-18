<?php
/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

/* @var $this \CrazyCat\Cms\Block\Block */
$block = $this->getBlock();
?>
<div class="block block-cms-block">
    <?php if ( !$this->getHideTitle() ) : ?>
        <div class="block-title">
            <h1><?php echo $block->getData( 'title' ); ?></h1>
        </div>
    <?php endif; ?>
    <div class="block-content">
        <?php echo $block->getData( 'content' ); ?>
    </div>
</div>