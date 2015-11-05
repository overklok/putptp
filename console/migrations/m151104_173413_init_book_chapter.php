<?php

use yii\db\Schema;
use yii\db\Migration;

class m151104_173413_init_book_chapter extends Migration
{
    public function up()
    {
        $this->createTable('book_chapter', [
            'chapter_id' => $this->integer()->notNull(),
            'book_id' => $this->integer()->notNull(),
            'chapter_title' => $this->string(256)->defaultValue('NEW_CHAP'),
            'chapter_content' => $this->text(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('FK_book_chapter-book', 'book_chapter', 'book_id', 'book', 'book_id');

        $this->addPrimaryKey('PK_book AND chapter', 'book_chapter', ['book_id', 'chapter_id']);
    }

    public function down()
    {
        $this->dropTable('book_chapter');
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
