<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_info}}`.
 */
class m240916_192717_create_user_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Создаем таблицу user_info
        $this->createTable('{{%user_info}}', [
            'user_id' => $this->primaryKey(), // Основной ключ и связь с таблицей user
            'lastname' => $this->string(100)->notNull(),
            'firstname' => $this->string(100)->notNull(),
            'bio' => $this->text(),
            'contactPhone' => $this->string(20),
            'photo' => $this->string(), // Путь или имя файла
            'city' => $this->integer(),
        ]);

        // Добавляем внешний ключ для user_id, связываем с таблицей user
        $this->addForeignKey(
            'fk-user_info-user_id', // название ключа
            '{{%user_info}}', // таблица, где ключ создается
            'user_id', // поле в текущей таблице
            '{{%user}}', // таблица, на которую ссылаемся
            'id', // поле в таблице user
            'CASCADE' // действие при удалении пользователя
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаляем внешний ключ и таблицу user_info
        $this->dropForeignKey('fk-user_info-user_id', '{{%user_info}}');
        $this->dropTable('{{%user_info}}');
    }
}
