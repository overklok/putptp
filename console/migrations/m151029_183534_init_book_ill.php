<?php

use yii\db\Schema;
use yii\db\Migration;

class m151029_183534_init_book_ill extends Migration
{
    public function up()
    {
        $this->createTable('book_ill', [
            'book_ill_id' => $this->primaryKey(),
            'book_ill_url' => $this->string(14)->unique()->notNull(),
            'book_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('FK_book_file-book', 'book_file', 'book_id', 'book', 'book_id');
    }

    public function down()
    {
        $this->dropForeignKey('FK_book_ill-book', 'book_ill');
        $this->dropTable('book_ill');
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
