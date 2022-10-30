<?php

use Yii;
use yii\db\Migration;

/**
 * Class m190317_180000_acl_create_tables
 */
class m190317_180000_acl_create_tables extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        // Modules
        $this->createTable('{{%sys_modules}}',
            [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull()->defaultValue('1'),
            'name' => $this->string()->notNull(),
            'yii_module_id' => $this->string()->notNull(),
            'url' => $this->string()->null(),
            'logo' => $this->string()->null(),
            'icon' => $this->string()->null(),
            'css_class' => $this->string()->null(),
            'pos' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ], $tableOptions);

        $this->createIndex('m_name', '{{%sys_modules}}', 'name');

        // Add default Modules
        $this->batchInsert('sys_modules',
            ['id', 'status', 'name', 'yii_module_id', 'url', 'logo', 'icon', 'css_class', 'pos'],
            [
                [1, 1, 'Home', 'app-backend', 'site', null, null, null, 1],
            ]
        );

        $this->createTable('{{%sys_acls}}',
            [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull()->defaultValue('1'),
            'module_id' => $this->integer()->notNull(),
            'parent_id' => $this->integer()->null(),
            'controlleraction' => $this->string()->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'name' => $this->string(),
            'url' => $this->string()->null(),
            'description' => $this->string(),
            'pos' => $this->integer(),
            'css_class' => $this->string(),
            'user_function' => $this->string()->null()->comment('PUF=php user function'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ], $tableOptions);

        $this->createIndex('sortindex', '{{%sys_acls}}', ['module_id', 'parent_id', 'type']);

        // Add default ACLs
        $this->batchInsert('sys_acls',
            [
                'id', 'status', 'module_id', 'parent_id', 'controlleraction', 'type',
                'name', 'url', 'description', 'pos', 'css_class', 'user_function'
            ],
            [
                [   // Main menu element
                    1, 1, '1', null, 'site|index', 1,
                    'Home', '/', 'Homepage', 1, 'fa fa-home', null
                ],
                [   // Developer menu
                    2, 1, '1', null, 'developer|index', 1,
                    'Developer', null, 'Homepage', 999, 'fa fa-home', null
                ],
                [   // Developer menu - Gii
                    3, 1, '1', null, 'developer|gii', 2,
                    'Gii', 'gii', 'Gii', 1, 'fa fa-file-code-o', null
                ],
                [   // Developer menu - Debug
                    4, 1, '1', null, 'developer|gii', 2,
                    'Debug', 'debug', 'Debug', 2, 'fa fa-dashboard', null
                ],

            ]
        );

        // ACL Types
        $this->createTable('{{%sys_acl_types}}',
            [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->null(),
            ], $tableOptions);

        // Add Types
        $this->batchInsert('sys_acl_types', ['id', 'name', 'description'], [
            [1, 'Module', 'Main menu item'],
            [2, 'Level 1', 'Level 1 menu item'],
            [3, 'Level 2', 'Level 2 menu item'],
            [4, 'Level 3', 'Level 3 menu item'],
            [5, 'ACL', 'ACL type'],
            ]
        );

        // User groups
        $this->createTable('{{%sys_groups}}',
            [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull()->defaultValue('1'),
            'name' => $this->string()->notNull(),
            'level' => $this->integer()->notNull()->defaultValue('1')->comment('Higher means more power'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ], $tableOptions);

        // Add default Groups
        $this->batchInsert('sys_groups', ['id', 'status', 'name', 'level'], [
            [1, 1, 'Developer', 100],
            [2, 1, 'Administrator', 70],
            [3, 1, 'User', 50],
            ]
        );

        // ACL assigned to Groups
        $this->createTable(
            '{{%sys_group_acls}}',
            [
                'id' => $this->primaryKey(),
                'group_id' => $this->integer()->notNull(),
                'acl_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        // Add ACLS to Developer Group
        $this->batchInsert(
            'sys_group_acls',
            ['group_id', 'acl_id'],
            [
                [1, 1],
                [1, 2],
                [1, 3],
                [1, 4],
            ]
        );

        // ACL assigned to Users
        $this->createTable(
            '{{%sys_user_acls}}',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer()->notNull(),
                'acl_id' => $this->integer()->notNull(),
                'mode' => $this->smallInteger()->notNull()->defaultValue('1')->comment(
                    '1=add privileges;0=revoke privileges'
                ),
            ],
            $tableOptions
        );

        // Add group_id column to user table
        $table = Yii::$app->db->schema->getTableSchema('user');
        if (!isset($table->columns['group_id'])) {
            $this->addColumn('user', 'group_id', $this->integer()->notNull()->defaultValue(0)->after('status'));
        }
    }

    public function down()
    {
        $this->dropTable('{{%sys_modules}}');
        $this->dropTable('{{%sys_acls}}');
        $this->dropTable('{{%sys_groups}}');
        $this->dropTable('{{%sys_group_acls}}');
        $this->dropTable('{{%sys_user_acls}}');
        $this->dropColumn('user', 'group_id');
    }
}
