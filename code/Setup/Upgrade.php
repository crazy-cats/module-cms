<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Cms\Setup;

use CrazyCat\Framework\App\Db\MySql;

/**
 * @category CrazyCat
 * @package CrazyCat\Cms
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Upgrade extends \CrazyCat\Framework\App\Module\Setup\AbstractUpgrade {

    private function createCmsBlockTable()
    {
        $columns = [
                [ 'name' => 'id', 'type' => MySql::COL_TYPE_INT, 'unsign' => true, 'null' => false, 'auto_increment' => true ],
                [ 'name' => 'title', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 256, 'null' => false ],
                [ 'name' => 'identifier', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 32, 'null' => false ],
                [ 'name' => 'enabled', 'type' => MySql::COL_TYPE_TINYINT, 'length' => 1, 'unsign' => true, 'null' => false, 'default' => 0 ],
                [ 'name' => 'stage_id', 'type' => MySql::COL_TYPE_INT, 'unsign' => true, 'null' => false, 'default' => 0 ],
                [ 'name' => 'content', 'type' => MySql::COL_TYPE_TEXT ],
                [ 'name' => 'created_at', 'type' => MySql::COL_TYPE_DATETIME, 'null' => false ],
                [ 'name' => 'updated_at', 'type' => MySql::COL_TYPE_DATETIME, 'null' => false ]
        ];
        $indexes = [
                [ 'columns' => [ 'identifier' ], 'type' => MySql::INDEX_NORMAL ],
                [ 'columns' => [ 'enabled' ], 'type' => MySql::INDEX_NORMAL ],
                [ 'columns' => [ 'stage_id' ], 'type' => MySql::INDEX_NORMAL ],
                [ 'columns' => [ 'created_at' ], 'type' => MySql::INDEX_NORMAL ],
                [ 'columns' => [ 'updated_at' ], 'type' => MySql::INDEX_NORMAL ],
                [ 'columns' => [ 'title' ], 'type' => MySql::INDEX_FULLTEXT ]
        ];
        $this->conn->createTable( 'cms_block', $columns, $indexes );
    }

    private function createCmsPageTable()
    {
        $columns = [
                [ 'name' => 'id', 'type' => MySql::COL_TYPE_INT, 'unsign' => true, 'null' => false, 'auto_increment' => true ],
                [ 'name' => 'title', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 256, 'null' => false ],
                [ 'name' => 'identifier', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 32, 'null' => false ],
                [ 'name' => 'enabled', 'type' => MySql::COL_TYPE_TINYINT, 'length' => 1, 'unsign' => true, 'null' => false, 'default' => 0 ],
                [ 'name' => 'stage_id', 'type' => MySql::COL_TYPE_INT, 'unsign' => true, 'null' => false, 'default' => 0 ],
                [ 'name' => 'content', 'type' => MySql::COL_TYPE_TEXT ],
                [ 'name' => 'meta_keywords', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 256 ],
                [ 'name' => 'meta_description', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 256 ],
                [ 'name' => 'sort_order', 'type' => MySql::COL_TYPE_INT, 'length' => 8, 'unsign' => true, 'default' => 0 ],
                [ 'name' => 'layout', 'type' => MySql::COL_TYPE_TEXT ],
                [ 'name' => 'created_at', 'type' => MySql::COL_TYPE_DATETIME, 'null' => false ],
                [ 'name' => 'updated_at', 'type' => MySql::COL_TYPE_DATETIME, 'null' => false ]
        ];
        $indexes = [
                [ 'columns' => [ 'identifier' ], 'type' => MySql::INDEX_NORMAL ],
                [ 'columns' => [ 'enabled' ], 'type' => MySql::INDEX_NORMAL ],
                [ 'columns' => [ 'stage_id' ], 'type' => MySql::INDEX_NORMAL ],
                [ 'columns' => [ 'sort_order' ], 'type' => MySql::INDEX_NORMAL ],
                [ 'columns' => [ 'created_at' ], 'type' => MySql::INDEX_NORMAL ],
                [ 'columns' => [ 'updated_at' ], 'type' => MySql::INDEX_NORMAL ],
                [ 'columns' => [ 'title' ], 'type' => MySql::INDEX_FULLTEXT ],
                [ 'columns' => [ 'content' ], 'type' => MySql::INDEX_FULLTEXT ]
        ];
        $this->conn->createTable( 'cms_page', $columns, $indexes );
    }

    /**
     * @param string|null $currentVersion
     */
    public function execute( $currentVersion )
    {
        if ( $currentVersion === null ) {
            $this->createCmsBlockTable();
            $this->createCmsPageTable();
        }
    }

}
