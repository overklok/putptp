<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_183002_init_book_settings extends Migration
{
    public function up()
    {
        $this->createTable('book_settings', [
            'book_id' => $this->integer()->notNull(),
            'book_images_cat' => $this->string(10)->notNull()->defaultValue('default'),
            'book_desc_problem' => $this->string(35),
            'book_desc_characters' => $this->string(250),

            'book_set_f1' => $this->boolean()->notNull(),
            'book_set_f2' => $this->boolean()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('FK_book_settings-book', 'book_settings', 'book_id', 'book', 'book_id');
    }

    public function down()
    {
        $this->dropForeignKey('FK_book_settings-book', 'book_settings');

        $this->dropTable('book_settings');
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
