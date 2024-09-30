<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * @property string|null $firstname
 * @property string|null $lastname
 */
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
        $firstname = ($this->firstname !== false) ? $this->firstname : '';
        $lastname = ($this->lastname !== false) ? $this->lastname : '';

        return $lastname . ' ' . $firstname;
    }

    public function getPhoto(){
        return !is_null($this->photo) ? '/'.$this->photo : "https://placehold.co/150x150";
    }
}
