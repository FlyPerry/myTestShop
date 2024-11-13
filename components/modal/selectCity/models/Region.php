<?php
namespace app\components\modal\selectCity\models;

use yii\db\ActiveRecord;

class Region extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%region}}';
    }

    /**
     * Связь с таблицей district
     */
    public function getDistricts()
    {
        return $this->hasMany(District::class, ['region_id' => 'id']);
    }
}
