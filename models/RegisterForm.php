<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class SignupForm extends Model
{
    public $email;
    public $password;
    public $confirmPassword;

    public function rules()
    {
        return [
            [['email', 'password', 'confirmPassword'], 'required'],
            ['email', 'email'],
            ['password', 'string', 'min' => 6],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
        ];
    }

    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            return $user->save();
        }
        return false;
    }
}
