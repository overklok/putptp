<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_185455_populate_books extends Migration
{
    public function up()
    {
        $typedata = [
            'book'  =>  'Book',
            'artic' =>  'Article',
            'verse' =>  'Verse',
            'period'=>  'Periodicals'
        ];

        $genredata = [
            'art'   =>  'Art, Design & Culture',
            'bio'   =>  'Biographies & Memoirs',
            'bus'   =>  'Business & Investing',
            'child' =>  'Children’s Books',
            'comp'  =>  'Computers & Technology',
            'home'  =>  'Home, family, hobbies & leisure',
            'edu'   =>  'Education',
            'fict'  =>  'Fiction',
            'heal'  =>  'Health, beauty & Sports',
            'hist'  =>  'History',
            'med'   =>  'Medicine',
            'horr'  =>  'Horror, Mystery & Thriller',
            'polit' =>  'Politics & Current Events',
            'psy'   =>  'Psychology',
            'rom'   =>  'Romance',
            'ero'   =>  'Erotic and Sex',
            'eso'   =>  'Esoterics',
            'sci'   =>  'Science & Technology',
            'docuf' =>  'Docufiction',
            'fant'  =>  'Fantasy',
            'encyc' =>  'Dictionaries, encyclopedias',
            'act'   =>  'Action & Adventure',
            'crime' =>  'Crime',
            'poet'  =>  'Poetry & Dramaturgy',
            'novel' =>  'Novels, short stories',
            'prose' =>  'Prose',
            'magic' =>  'Magic realism',
            'west'  =>  'Western',
            'saga'  =>  'Saga',
            'philo' =>  'Philosophical',
            'comic' =>  'Comic',
            'scifi' =>  'Science Fiction & Fantasy',
        ];

        foreach ($typedata as $name => $title) {
            $this->insert('book_type', [
                    'book_type_name' => $name,
                    'book_type_title' => $title,
            ]);
        }

        foreach ($genredata as $name => $title) {
            $this->insert('genre', [
                'genre_name' => $name,
                'genre_title' => $title,
            ]);
        }
    }

    public function down()
    {
        $this->delete('genre', []);
        $this->delete('book_type', []);
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
