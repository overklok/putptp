<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_172908_init_books extends Migration
{
    public function up()
    {
        $this->createTable('book_type', [
            'book_type_id' => $this->primaryKey(),
            'book_type_name' => $this->string()->notNull()->unique(),
            'book_type_title' => $this->string(50),
        ]);

        $this->createTable('genre', [
            'genre_id' => $this->primaryKey(),
            'genre_name' => $this->string()->notNull()->unique(),
            'genre_title' => $this->string(50),
        ]);

        $this->createTable('book', [
            'book_id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'book_type_id' => $this->integer()->notNull(),
            'genre_id' => $this->integer()->notNull(),
            'book_title' => $this->string()->unique(),
            'book_description' => $this->string(),
            'book_status' => $this->smallInteger()->notNull()->defaultValue(1),

            'book_price' => $this->decimal(10,4)->notNull()->defaultValue(0.0),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('FK_book-author', 'book', 'author_id', 'user', 'user_id');
        $this->addForeignKey('FK_book-book_type', 'book', 'book_type_id', 'book_type', 'book_type_id');
        $this->addForeignKey('FK_book-genre', 'book', 'genre_id', 'genre', 'genre_id');
/*
        $this->createTable('page', [
            'book_id' => $this->integer()->notNull(),
            'page_number' => $this->integer()->notNull(),
            'page_content' => $this->text(),
        ]);

        $this->addPrimaryKey('PK_page_numeration', 'page',['book_id','page_number']);
        $this->addForeignKey('FK_page-book', 'page', 'book_id', 'book', 'book_id');
*/
    }

    public function down()
    {
    //  $this->dropForeignKey('FK_page-book', 'page');
    //  $this->dropTable('page');

        $this->dropForeignKey('FK_book-genre', 'book');
        $this->dropForeignKey('FK_book-book_type', 'book');
        $this->dropForeignKey('FK_book-author', 'book');

        $this->dropTable('genre');
        $this->dropTable('book_type');
        $this->dropTable('book');
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
