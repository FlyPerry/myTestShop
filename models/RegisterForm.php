<?php

namespace app\models;

use yii\base\Model;

class RegisterForm extends Model
{
    public $email;
    public $password;
    public $confirmPassword;

    public function rules()
    {
        return [
            [['email', 'password', 'confirmPassword'], 'required'],
            ['email', 'email'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],
        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->email = $this->email;
        $user->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
        $user->auth_key = \Yii::$app->security->generateRandomString();

        if ($user->save()) {
            // Авторизация после сохранения пользователя
            \Yii::$app->user->login($user);
            return true;
        }

        return $user->save();
    }
}
