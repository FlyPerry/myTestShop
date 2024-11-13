<?php

use yii\db\Migration;

/**
 * Class m241112_171203_tables_for_cities
 */
class m241112_171203_tables_for_cities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Создание таблицы для областей
        $this->createTable('{{%region}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('Название области'),
        ]);

        // Вставка записи с id = 0 для всех областей
        $this->insert('{{%region}}', [
            'id' => 1,
            'name' => 'Все области',
        ]);

        // Создание таблицы для районов (регионов в области)
        $this->createTable('{{%district}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('Название региона'),
            'region_id' => $this->integer()->notNull()->comment('ID области'),
        ]);

        // Вставка записи с id = 0 для всех регионов
        $this->insert('{{%district}}', [
            'id' => 1,
            'name' => 'Все регионы',
            'region_id' => 1,
        ]);

        // Создание таблицы для городов
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('Название города'),
            'district_id' => $this->integer()->notNull()->comment('ID региона'),
        ]);

        // Вставка записи с id = 0 для всех городов
        $this->insert('{{%city}}', [
            'id' => 1,
            'name' => 'Все города',
            'district_id' => 1,
        ]);

        // Добавление внешних ключей
        $this->addForeignKey(
            'fk-district-region_id',
            '{{%district}}',
            'region_id',
            '{{%region}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-city-district_id',
            '{{%city}}',
            'district_id',
            '{{%district}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаление внешних ключей
        $this->dropForeignKey('fk-city-district_id', '{{%city}}');
        $this->dropForeignKey('fk-district-region_id', '{{%district}}');

        // Удаление таблиц
        $this->dropTable('{{%city}}');
        $this->dropTable('{{%district}}');
        $this->dropTable('{{%region}}');
    }
}