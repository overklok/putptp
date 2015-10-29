<?php

use yii\db\Schema;
use yii\db\Migration;

class m130600_210000_init_rbac_tables extends Migration
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
        $this->dropTable('auth_item_child');
        $this->dropTable('auth_rule');
        $this->dropTable('auth_item');

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
