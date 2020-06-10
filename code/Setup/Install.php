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
            ['columns' => ['identifier'], 'type' => MySql::INDEX_NORMAL],
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

    private function createContentPageMainTable()
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
            ['columns' => ['identifier'], 'type' => MySql::INDEX_NORMAL],
            ['columns' => ['enabled'], 'type' => MySql::INDEX_NORMAL],
            ['columns' => ['stage_ids'], 'type' => MySql::INDEX_NORMAL],
            ['columns' => ['sort_order'], 'type' => MySql::INDEX_NORMAL]
        ];
        $this->conn->createTable('content_page', $columns, $indexes);
    }

    private function createContentPageLangTable()
    {
        $columns = [
            ['name' => 'id', 'type' => MySql::COL_TYPE_INT, 'unsign' => true, 'null' => false],
            ['name' => 'lang', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 8, 'null' => false],
            ['name' => 'title', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 256, 'null' => false],
            ['name' => 'content', 'type' => MySql::COL_TYPE_TEXT],
            ['name' => 'meta_keywords', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 256],
            ['name' => 'meta_description', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 256]
        ];
        $indexes = [
            ['columns' => ['id', 'lang'], 'type' => MySql::INDEX_UNIQUE],
            ['columns' => ['title'], 'type' => MySql::INDEX_FULLTEXT],
            ['columns' => ['content'], 'type' => MySql::INDEX_FULLTEXT]
        ];
        $this->conn->createTable('content_page_lang', $columns, $indexes);
    }

    /**
     * @param string|null $currentVersion
     */
    public function execute()
    {
        $this->createContentBlockMainTable();
        $this->createContentBlockLangTable();
        $this->createContentPageMainTable();
        $this->createContentPageLangTable();
    }
}
