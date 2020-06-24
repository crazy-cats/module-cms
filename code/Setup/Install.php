<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Setup;

use CrazyCat\Framework\App\Db\MySql;

/**
 * @category CrazyCat
 * @package  CrazyCat\Content
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Install extends \CrazyCat\Framework\App\Component\Module\Setup\AbstractSetup
{
    private function createContentBlockMainTable()
    {
        $columns = [
            [
                'name'           => 'id',
                'type'           => MySql::COL_TYPE_INT,
                'unsign'         => true,
                'null'           => false,
                'auto_increment' => true
            ],
            [
                'name'   => 'identifier',
                'type'   => MySql::COL_TYPE_VARCHAR,
                'length' => 32,
                'null'   => false
            ],
            [
                'name'    => 'enabled',
                'type'    => MySql::COL_TYPE_TINYINT,
                'length'  => 1,
                'unsign'  => true,
                'null'    => false,
                'default' => 0
            ],
            [
                'name'    => 'stage_ids',
                'type'    => MySql::COL_TYPE_VARCHAR,
                'length'  => 32,
                'null'    => false,
                'default' => '0'
            ]
        ];
        $indexes = [
            ['columns' => ['identifier'], 'type' => MySql::INDEX_UNIQUE],
            ['columns' => ['enabled'], 'type' => MySql::INDEX_NORMAL],
            ['columns' => ['stage_ids'], 'type' => MySql::INDEX_NORMAL]
        ];
        $this->conn->createTable('content_block', $columns, $indexes);
    }

    private function createContentBlockLangTable()
    {
        $columns = [
            ['name' => 'id', 'type' => MySql::COL_TYPE_INT, 'unsign' => true, 'null' => false],
            ['name' => 'lang', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 8, 'null' => false],
            ['name' => 'title', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 256, 'null' => false],
            ['name' => 'content', 'type' => MySql::COL_TYPE_TEXT]
        ];
        $indexes = [
            ['columns' => ['id', 'lang'], 'type' => MySql::INDEX_UNIQUE],
            ['columns' => ['title'], 'type' => MySql::INDEX_FULLTEXT]
        ];
        $this->conn->createTable('content_block_lang', $columns, $indexes);
    }

    private function createArticleMainTable()
    {
        $columns = [
            [
                'name'           => 'id',
                'type'           => MySql::COL_TYPE_INT,
                'unsign'         => true,
                'null'           => false,
                'auto_increment' => true
            ],
            [
                'name'   => 'identifier',
                'type'   => MySql::COL_TYPE_VARCHAR,
                'length' => 32,
                'null'   => false
            ],
            [
                'name'    => 'enabled',
                'type'    => MySql::COL_TYPE_TINYINT,
                'length'  => 1,
                'unsign'  => true,
                'null'    => false,
                'default' => 0
            ],
            [
                'name'    => 'stage_ids',
                'type'    => MySql::COL_TYPE_VARCHAR,
                'length'  => 32,
                'null'    => false,
                'default' => '0'
            ],
            [
                'name'    => 'category_ids',
                'type'    => MySql::COL_TYPE_VARCHAR,
                'length'  => 32,
                'null'    => false,
                'default' => '0'
            ],
            [
                'name'    => 'sort_order',
                'type'    => MySql::COL_TYPE_INT,
                'length'  => 8,
                'unsign'  => true,
                'default' => 0
            ],
            [
                'name' => 'layout',
                'type' => MySql::COL_TYPE_TEXT
            ],
            [
                'name'   => 'meta_robots',
                'type'   => MySql::COL_TYPE_VARCHAR,
                'length' => 32
            ]
        ];
        $indexes = [
            ['columns' => ['identifier'], 'type' => MySql::INDEX_UNIQUE],
            ['columns' => ['enabled'], 'type' => MySql::INDEX_NORMAL],
            ['columns' => ['stage_ids'], 'type' => MySql::INDEX_NORMAL],
            ['columns' => ['category_ids'], 'type' => MySql::INDEX_NORMAL],
            ['columns' => ['sort_order'], 'type' => MySql::INDEX_NORMAL]
        ];
        $this->conn->createTable('article', $columns, $indexes);
    }

    private function createArticleLangTable()
    {
        $columns = [
            ['name' => 'id', 'type' => MySql::COL_TYPE_INT, 'unsign' => true, 'null' => false],
            ['name' => 'lang', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 8, 'null' => false],
            ['name' => 'title', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 256, 'null' => false],
            ['name' => 'short_content', 'type' => MySql::COL_TYPE_TEXT],
            ['name' => 'content', 'type' => MySql::COL_TYPE_TEXT],
            ['name' => 'meta_keywords', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 256],
            ['name' => 'meta_description', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 256]
        ];
        $indexes = [
            ['columns' => ['id', 'lang'], 'type' => MySql::INDEX_UNIQUE],
            ['columns' => ['title'], 'type' => MySql::INDEX_FULLTEXT],
            ['columns' => ['short_content'], 'type' => MySql::INDEX_FULLTEXT],
            ['columns' => ['content'], 'type' => MySql::INDEX_FULLTEXT]
        ];
        $this->conn->createTable('article_lang', $columns, $indexes);
    }

    private function createArticleCategoryMainTable()
    {
        $columns = [
            [
                'name'           => 'id',
                'type'           => MySql::COL_TYPE_INT,
                'unsign'         => true,
                'null'           => false,
                'auto_increment' => true
            ],
            [
                'name'   => 'identifier',
                'type'   => MySql::COL_TYPE_VARCHAR,
                'length' => 32,
                'null'   => false
            ],
            [
                'name'    => 'enabled',
                'type'    => MySql::COL_TYPE_TINYINT,
                'length'  => 1,
                'unsign'  => true,
                'null'    => false,
                'default' => 0
            ],
            [
                'name'    => 'stage_ids',
                'type'    => MySql::COL_TYPE_VARCHAR,
                'length'  => 32,
                'null'    => false,
                'default' => '0'
            ],
            [
                'name'    => 'parent_id',
                'type'    => MySql::COL_TYPE_INT,
                'unsign'  => true,
                'null'    => false,
                'default' => 0
            ],
            [
                'name'   => 'path',
                'type'   => MySql::COL_TYPE_VARCHAR,
                'length' => 32,
                'null'   => true
            ],
            [
                'name'    => 'sort_order',
                'type'    => MySql::COL_TYPE_INT,
                'length'  => 8,
                'unsign'  => true,
                'default' => 0
            ],
            [
                'name' => 'layout',
                'type' => MySql::COL_TYPE_TEXT
            ],
            [
                'name'   => 'meta_robots',
                'type'   => MySql::COL_TYPE_VARCHAR,
                'length' => 32
            ]
        ];
        $indexes = [
            ['columns' => ['identifier'], 'type' => MySql::INDEX_UNIQUE],
            ['columns' => ['enabled'], 'type' => MySql::INDEX_NORMAL],
            ['columns' => ['stage_ids'], 'type' => MySql::INDEX_NORMAL],
            ['columns' => ['parent_id'], 'type' => MySql::INDEX_NORMAL],
            ['columns' => ['path'], 'type' => MySql::INDEX_NORMAL],
            ['columns' => ['sort_order'], 'type' => MySql::INDEX_NORMAL]
        ];
        $this->conn->createTable('article_category', $columns, $indexes);
    }

    private function createArticleCategoryLangTable()
    {
        $columns = [
            ['name' => 'id', 'type' => MySql::COL_TYPE_INT, 'unsign' => true, 'null' => false],
            ['name' => 'lang', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 8, 'null' => false],
            ['name' => 'name', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 256, 'null' => false],
            ['name' => 'description', 'type' => MySql::COL_TYPE_TEXT],
            ['name' => 'meta_keywords', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 256],
            ['name' => 'meta_description', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 256]
        ];
        $indexes = [
            ['columns' => ['id', 'lang'], 'type' => MySql::INDEX_UNIQUE],
            ['columns' => ['name'], 'type' => MySql::INDEX_FULLTEXT],
            ['columns' => ['description'], 'type' => MySql::INDEX_FULLTEXT]
        ];
        $this->conn->createTable('article_category_lang', $columns, $indexes);
    }

    /**
     * @return void
     */
    public function execute()
    {
        $this->createContentBlockMainTable();
        $this->createContentBlockLangTable();
        $this->createArticleMainTable();
        $this->createArticleLangTable();
        $this->createArticleCategoryMainTable();
        $this->createArticleCategoryLangTable();
    }
}
