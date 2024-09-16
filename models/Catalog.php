<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalog".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $name
 * @property string|null $description
 * @property int|null $deleted
 * @property string $date_create
 * @property string $date_update
 * @property int|null $verify
 * @property int|null $danger
 */
class Catalog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'name', 'date_create', 'date_update'], 'required'],
            [['user_id', 'deleted', 'verify', 'danger'], 'integer'],
            [['description'], 'string'],
            [['date_create', 'date_update'], 'safe'],
            [['type', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'name' => 'Name',
            'description' => 'Description',
            'deleted' => 'Deleted',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'verify' => 'Verify',
            'danger' => 'Danger',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
