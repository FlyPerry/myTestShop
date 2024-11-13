<?php
namespace app\components\modal\selectCity\models;

use yii\db\ActiveRecord;

class District extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%district}}';
    }

    /**
     * Связь с таблицей region
     */
    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'region_id']);
    }

    /**
     * Связь с таблицей city
     */
    public function getCities()
    {
        return $this->hasMany(City::class, ['district_id' => 'id']);
    }
}
