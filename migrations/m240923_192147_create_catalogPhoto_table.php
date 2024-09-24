<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catalogPhoto}}`.
 */
class m240923_192147_create_catalogPhoto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Создание таблицы catalogPhoto
        $this->createTable('{{%catalogPhoto}}', [
            'id' => $this->primaryKey(),
            'catalogID' => $this->integer()->notNull(), // Связь с таблицей catalog
            'photo' => $this->string()->notNull(), // Ссылка на фото
            'active' => $this->boolean()->defaultValue(1), // Активен ли
            'verify' => $this->boolean()->defaultValue(0), // Верификация
            'deleted' => $this->boolean()->defaultValue(0), // Удалён ли
            'ext' => $this->string(10)->notNull(), // Расширение файла (например, jpg, png)
            'size' => $this->integer()->notNull(), // Размер файла
            'date_create' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'), // Дата создания
            'date_update' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'), // Дата обновления
        ]);

        // Создание индекса и внешнего ключа на поле catalogID, связываем с таблицей catalog
        $this->createIndex(
            '{{%idx-catalogPhoto-catalogID}}',
            '{{%catalogPhoto}}',
            'catalogID'
        );

        $this->addForeignKey(
            '{{%fk-catalogPhoto-catalogID}}',
            '{{%catalogPhoto}}',
            'catalogID',
            '{{%catalog}}',
            'id',
            'CASCADE', // Удалять записи catalogPhoto при удалении связанного catalog
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаление внешнего ключа и индекса
        $this->dropForeignKey(
            '{{%fk-catalogPhoto-catalogID}}',
            '{{%catalogPhoto}}'
        );

        $this->dropIndex(
            '{{%idx-catalogPhoto-catalogID}}',
            '{{%catalogPhoto}}'
        );

        // Удаление таблицы
        $this->dropTable('{{%catalogPhoto}}');
    }
}
