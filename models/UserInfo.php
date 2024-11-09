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
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['bio'], 'string'],
            [['lastname', 'firstname', 'contactPhone', 'photo', 'city'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
        ];
    }

    public function attributeLabels()
    {

        return [
            'lastname' => \Yii::t('app', 'lastname'),
            'firstname' => \Yii::t('app', 'firstname'),
            'bio' => \Yii::t('app', 'bio'),
            'contactPhone' => \Yii::t('app', 'contactPhone'),
            'photo' => \Yii::t('app', 'photo'),
            'city' => \Yii::t('app', 'city'),
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

    public function getPhoto()
    {
        return !is_null($this->photo) ? '/' . $this->photo : "https://placehold.co/150x150";
    }
}
