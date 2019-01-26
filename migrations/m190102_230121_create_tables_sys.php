<?php

use yii\db\Migration;

class m190102_230121_create_tables_sys extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%sys_acl_group}}', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'acl_id' => $this->integer()->notNull(),
        ], $tableOptions);


        $this->createTable('{{%sys_acl_user}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'acl_id' => $this->integer()->notNull(),
            'aclu_mode' => $this->smallInteger()->notNull()->defaultValue('1')->comment('1=add privileges;0=revoke privileges'),
        ], $tableOptions);


        $this->createTable('{{%sys_acls}}', [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull()->defaultValue('1'),
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
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('sortindex', '{{%sys_acls}}', ['module_id', 'parent_id', 'type']);


        $this->createTable('{{%sys_groups}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'level' => $this->integer()->notNull()->defaultValue('1')->comment('higher is more power'),
            'status' => $this->smallInteger()->notNull()->defaultValue('1'),
        ], $tableOptions);


        $this->createTable('{{%sys_modules}}', [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull()->defaultValue('1'),
            'name' => $this->string()->notNull(),
            'yii_module_id' => $this->string()->notNull(),
            'url' => $this->string(),
            'logo' => $this->string(),
            'icon' => $this->string(),
            'css_class' => $this->string(),
            'pos' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('m_name', '{{%sys_modules}}', 'name');

    }

    public function down()
    {
        $this->dropTable('{{%sys_acl_group}}');
        $this->dropTable('{{%sys_acl_user}}');
        $this->dropTable('{{%sys_acls}}');
        $this->dropTable('{{%sys_groups}}');
        $this->dropTable('{{%sys_modules}}');

    }
}

