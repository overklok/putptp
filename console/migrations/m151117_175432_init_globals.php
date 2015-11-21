<?php

use yii\db\Schema;
use yii\db\Migration;

class m151117_175432_init_globals extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('currency', [
            'currency_id' => $this->primaryKey(),
            'currency_name' => $this->string(3)->notNull()->unique(),
            'currency_rate' => $this->decimal(10,4)->notNull(),
            'currency_title' => $this->string()->defaultValue('untitled'),
            'updated_at' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('currency');
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
