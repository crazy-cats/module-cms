<?php
/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

/* @var $this \CrazyCat\Cms\Block\Page */
$page = $this->getPage();
?>
<div class="block block-cms-page">
    <div class="block-title">
        <h1><?php echo $page->getData( 'title' ); ?></h1>
    </div>
    <div class="block-content">
        <?php echo $page->getData( 'content' ); ?>
    </div>
</div>