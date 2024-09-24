<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 */
class Category extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Category Name',
            'type' => 'Category Type',
        ];
    }
    public function getTranslatedType()
    {
        switch ($this->type) {
            case 'man':
                return 'Мужчины';
            case 'women':
                return 'Женщины';
            case 'work':
                return 'Услуги';
            default:
                return $this->type; // В других случаях вернуть оригинальное значение
        }
    }
}
