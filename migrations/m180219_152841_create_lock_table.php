<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lock}}`.
 */
class m180219_152841_create_lock_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lock}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->unique()->notNull(),
            'created_at' => $this->integer(),
        ]);

        $this->createIndex('{{%idx-lock-name}}', '{{%lock}}', 'name', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('{{%idx-lock-name}}', '{{%lock}}');
        $this->dropTable('{{%lock}}');
    }
}
