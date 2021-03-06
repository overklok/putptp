<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_182515_init_user_settings extends Migration
{
    public function up()
    {
        $this->createTable('user_settings', [
            'user_id' => $this->primaryKey(),

            'user_first_name' => $this->string()->notNull(),
            'user_middle_name' => $this->string()->notNull(),
            'user_last_name' => $this->string()->notNull(),

            'user_res_f1' => $this->boolean()->notNull(),
            'user_res_f2' => $this->boolean()->notNull(),
            'user_image_url' => $this->string()->notNull()->defaultValue('missing_user.png'),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('FK_user_settings-user', 'user_settings', 'user_id', 'user', 'user_id');
    }

    public function down()
    {
        $this->dropForeignKey('FK_user_settings-user', 'user_settings');

        $this->dropTable('user_settings');
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
