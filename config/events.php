<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

/**
 * @category CrazyCat
 * @package  CrazyCat\Content
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
return [
    'article_save_after'          => 'CrazyCat\Content\Observer\UpdateArticleUrlRewrites',
    'article_category_save_after' => 'CrazyCat\Content\Observer\UpdateArticleCategoryUrlRewrites'
];
