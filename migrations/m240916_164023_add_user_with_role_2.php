<?php

use yii\db\Migration;

/**
 * Class m240916_164023_add_user_with_role_2
 */
class m240916_164023_add_user_with_role_2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Добавляем пользователя с ролью 2
        $this->insert('user', [
            'email' => 'user@example.com', // Email пользователя
            'auth_key' => Yii::$app->security->generateRandomString(), // Генерация auth_key
            'password_hash' => Yii::$app->security->generatePasswordHash('password123'), // Хэш пароля
            'role' => 2, // Роль 2
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаляем пользователя по email
        $this->delete('user', ['email' => 'user@example.com']);
    }
}
