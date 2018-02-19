<?php

use yii\db\Migration;
use app\models\User;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m180219_074337_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey()->unsigned(),
            'email' => $this->string()->unique()->notNull(),
            'auth_key' => $this->string(36)->notNull(),
            'access_token' => $this->string(36)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'role' => $this->smallInteger()->unsigned()->notNull()->defaultValue(User::ROLE_USER),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex('{{%idx-user-email}}', '{{%user}}', 'email', true);

        $user = new User();
        $user->email = "admin@example.com";
        $user->setPassword("admin@example.com");
        $user->role = User::ROLE_ADMIN;
        $user->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('{{%idx-user-email}}', '{{%user}}');
        $this->dropTable('{{%user}}');
    }
}
