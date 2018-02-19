<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%key}}`.
 */
class m180219_152852_create_key_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%key}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->unique()->notNull(),
            'lock_id' => $this->integer()->unsigned()->notNull(),
            'user_id' => $this->integer()->unsigned(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex('{{%idx-key-name}}', '{{%key}}', 'name', true);
        $this->addForeignKey('{{%fk-lock-key}}', '{{%key}}', 'lock_id', '{{%lock}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%fk-user-key}}', '{{%key}}', 'user_id', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-user-key}}', '{{%key}}');
        $this->dropForeignKey('{{%fk-lock-key}}', '{{%key}}');
        $this->dropIndex('{{%idx-key-name}}', '{{%key}}');
        $this->dropTable('{{%key}}');
    }
}
