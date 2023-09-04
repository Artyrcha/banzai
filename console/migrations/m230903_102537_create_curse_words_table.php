<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%curse_words}}`.
 */
class m230903_102537_create_curse_words_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%curse_words}}', [
            'id' => $this->primaryKey(),
            'word' => $this->string(255)->notNull(),
        ]);

        $this->batchInsert('{{%curse_words}}', ['word'], [
                ['Блядь'],
                ['Ебать'],
                ['Пизда'],
                ['Сука'],
                ['Хуй'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%curse_words}}');
    }
}
