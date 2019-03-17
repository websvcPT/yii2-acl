<?php

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
        $this->createTable('{{%w_modules}}',
            [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull()->defaultValue('1'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'name' => $this->string()->notNull(),
            'yii_module_id' => $this->string()->notNull(),
            'url' => $this->string(),
            'logo' => $this->string(),
            'icon' => $this->string(),
            'css_class' => $this->string(),
            'pos' => $this->integer()->notNull(),
            ], $tableOptions);

        $this->createIndex('m_name', '{{%w_modules}}', 'name');

        $this->createTable('{{%w_acls}}',
            [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull()->defaultValue('1'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'module_id' => $this->integer()->notNull(),
            'parent_id' => $this->integer(),
            'controlleraction' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'name' => $this->string(),
            'url' => $this->string(),
            'description' => $this->string(),
            'pos' => $this->integer(),
            'css_class' => $this->string(),
            'user_function' => $this->string()->comment('PUF=php user function'),
            ], $tableOptions);

        $this->createIndex('sortindex', '{{%w_acls}}', ['module_id', 'parent_id', 'type']);

        // User groups
        $this->createTable('{{%w_groups}}',
            [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull()->defaultValue('1'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'name' => $this->string()->notNull(),
            'level' => $this->integer()->notNull()->defaultValue('1')->comment('Higher is more power'),
            ], $tableOptions);

        // ACL assigned to Groups
        $this->createTable('{{%w_group_acls}}',
            [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'acl_id' => $this->integer()->notNull(),
            ], $tableOptions);

        // ACL assigned to Users
        $this->createTable('{{%w_user_acls}}',
            [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'acl_id' => $this->integer()->notNull(),
            'mode' => $this->smallInteger()->notNull()->defaultValue('1')->comment('1=add privileges;0=revoke privileges'),
            ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%w_modules}}');
        $this->dropTable('{{%w_acls}}');
        $this->dropTable('{{%w_groups}}');
        $this->dropTable('{{%w_group_acls}}');
        $this->dropTable('{{%w_user_acls}}');
    }

}
