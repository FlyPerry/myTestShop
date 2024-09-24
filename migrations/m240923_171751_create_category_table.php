<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m240923_171751_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Создаем таблицу category
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'type' => $this->string(50)->notNull(),
        ]);

        // Вставляем категории для man
        $this->batchInsert('{{%category}}', ['name', 'type'], [
            ['Category 1', 'man'],
            ['Category 2', 'man'],
            ['Category 3', 'man'],
            ['Category 4', 'man'],
            ['Category 5', 'man'],
            ['Category 6', 'man'],
            ['Category 7', 'man'],
            ['Category 8', 'man'],
            ['Category 9', 'man'],
            ['Category 10', 'man'],
            ['Category 11', 'man'],
            ['Category 12', 'man'],
            ['Category 13', 'man'],
            ['Category 14', 'man'],
            ['Category 15', 'man'],
        ]);

        // Вставляем категории для women
        $this->batchInsert('{{%category}}', ['name', 'type'], [
            ['Category 1', 'women'],
            ['Category 2', 'women'],
            ['Category 3', 'women'],
            ['Category 4', 'women'],
            ['Category 5', 'women'],
            ['Category 6', 'women'],
            ['Category 7', 'women'],
            ['Category 8', 'women'],
            ['Category 9', 'women'],
            ['Category 10', 'women'],
            ['Category 11', 'women'],
            ['Category 12', 'women'],
            ['Category 13', 'women'],
            ['Category 14', 'women'],
            ['Category 15', 'women'],
        ]);

        // Вставляем категории для work
        $this->batchInsert('{{%category}}', ['name', 'type'], [
            ['Category 1', 'work'],
            ['Category 2', 'work'],
            ['Category 3', 'work'],
            ['Category 4', 'work'],
            ['Category 5', 'work'],
            ['Category 6', 'work'],
            ['Category 7', 'work'],
            ['Category 8', 'work'],
            ['Category 9', 'work'],
            ['Category 10', 'work'],
            ['Category 11', 'work'],
            ['Category 12', 'work'],
            ['Category 13', 'work'],
            ['Category 14', 'work'],
            ['Category 15', 'work'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаляем таблицу category
        $this->dropTable('{{%category}}');
    }
}
