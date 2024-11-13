<?php

namespace app\components\modal\selectCity\models;

use yii\db\ActiveRecord;

class City extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * Связь с таблицей district
     */
    public function getDistrict()
    {
        return $this->hasOne(District::class, ['id' => 'district_id']);
    }
}
