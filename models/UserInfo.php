<?php

namespace app\models;

use yii\db\ActiveRecord;

class UserInfo extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%user_info}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'lastname', 'firstname'], 'required'],
            [['user_id'], 'integer'],
            [['bio'], 'string'],
            [['lastname', 'firstname', 'contactPhone', 'photo', 'city'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
        ];
    }

    public function attributeLabels()
    {

        return [
            'lastname' => 'Фамилия',
            'firstname' => 'Имя',
            'bio' => 'Биография',
            'contactPhone' => 'Контактный телефон',
            'photo' => 'Фото',
            'city' => 'Город',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getFio()
    {
        return $this->lastname . ' ' . $this->firstname;
    }
}
