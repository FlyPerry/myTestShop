<?php

namespace app\models;

use yii\base\Model;
use Yii;

class LoginForm extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'string'],
        ];
    }

    public function login()
    {
        // Проверка валидации формы
        if (!$this->validate()) {
            return false;
        }

        // Поиск пользователя по email
        $user = User::findOne(['email' => $this->email]);

        // Проверка наличия пользователя и валидности пароля
        if (!$user || !Yii::$app->security->validatePassword($this->password, $user->password_hash)) {
            $this->addError('password', 'Неверный email или пароль.');
            return false;
        }

        // Выполнение авторизации пользователя
        return Yii::$app->user->login($user, 3600*24*30); // 30 дней
    }

    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
