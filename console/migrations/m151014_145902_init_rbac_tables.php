<?php

use yii\db\Schema;
use yii\db\Migration;

class m151014_145902_init_rbac_tables extends Migration
{
    public function up()
    {
        $this->execute(
            file_get_contents(
                Yii::getAlias('@yii/rbac/migrations/schema-mysql.sql')));
    }

    public function down()
    {
        $this->dropTable('auth_assignment');
        $this->dropTable('auth_item');
        $this->dropTable('auth_rule');
        $this->dropTable('auth_item_child');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
