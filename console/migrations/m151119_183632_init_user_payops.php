<?php

use yii\db\Schema;
use yii\db\Migration;

class m151119_183632_init_user_payops extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%user_payops}}', [
            'op_id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'op_value' => $this->decimal(10,4)->notNull(),
            'op_desc' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('FK_user_payops-user', 'user_payops', 'user_id', 'user', 'user_id');

    }

    public function down()
    {
        $this->dropForeignKey('FK_user_payops-user', 'user_payops');
        $this->dropTable('user_payops');
        return false;
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
