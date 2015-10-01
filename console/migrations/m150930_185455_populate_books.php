<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_185455_populate_books extends Migration
{
    public function up()
    {
        $this->insert('genre', [
            'genre_name' => 'default',
            'genre_title' => 'Default Genre of book',
        ]);

        $this->insert('book_type', [
            'book_type_name' => 'default',
            'book_type_title' => 'Default Type of book',
        ]);
    }

    public function down()
    {
        $this->delete('genre', ['genre_name' => 'default']);
        $this->delete('book_type', ['book_type_name' => 'default']);
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
