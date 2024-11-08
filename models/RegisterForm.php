<?php

namespace app\models;

use PharIo\Version\NoBuildMetaDataException;
use yii\base\ErrorException;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\db\Exception;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;


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
            // Создание пустой записи в UserInfo
            $userInfo = new UserInfo();
            $userInfo->user_id = $user->id; // Установка связи по ID пользователя
            $userInfo->firstname = ' ';      // Пустое значение для имени
            $userInfo->lastname = ' ';       // Пустое значение для фамилии
            $userInfo->bio = ' ';            // Пустое значение для биографии

            // Попытка сохранить запись UserInfo
            if (!$userInfo->save()) {
                // Если сохранение не удалось, вывод ошибок для отладки
                \Yii::error('Ошибка при создании записи UserInfo: ' . json_encode($userInfo->getErrors()));
                return false;
            }

            // Авторизация после сохранения пользователя
            \Yii::$app->user->login($user);
            return true;
        }

        // Если сохранение пользователя не удалось
        \Yii::error('Ошибка при создании пользователя: ' . json_encode($user->getErrors()));
        return false;
    }

}
