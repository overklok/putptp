<?php

use yii\db\Migration;

class m130524_201442_init_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'user_id' => $this->primaryKey(),
            'user_name' => $this->string()->notNull()->unique(),
            'user_first_name' => $this->string()->notNull(),
            'user_middle_name' => $this->string()->notNull(),
            'user_last_name' => $this->string()->notNull(),
            'user_auth_key' => $this->string(32)->notNull(),
            'user_password_hash' => $this->string()->notNull(),
            'user_password_reset_token' => $this->string()->unique(),
            'user_email' => $this->string()->notNull()->unique(),
            'email_confirm_token' => $this->string(),
            'user_status' => $this->smallInteger()->notNull()->defaultValue(1),
            'user_DOB' => $this->date()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_user_username', '{{%user}}', 'user_name');
        $this->createIndex('idx_user_email', '{{%user}}', 'user_email');
        $this->createIndex('idx_user_status', '{{%user}}', 'user_status');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
