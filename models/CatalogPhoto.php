<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "catalogPhoto".
 *
 * @property int $id
 * @property int $catalogID
 * @property string $photo
 * @property bool $active
 * @property bool $verify
 * @property bool $deleted
 * @property string $ext
 * @property int $size
 * @property string $date_create
 * @property string $date_update
 */
class CatalogPhoto extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%catalogPhoto}}';
    }

    public function rules()
    {
        return [
            [['catalogID', 'photo', 'ext', 'size'], 'required'],
            [['catalogID', 'size'], 'integer'],
            [['active', 'verify', 'deleted'], 'boolean'],
            [['photo', 'ext'], 'string', 'max' => 255],
            [['date_create', 'date_update'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'catalogID' => 'Catalog ID',
            'photo' => 'Photo',
            'active' => 'Active',
            'verify' => 'Verify',
            'deleted' => 'Deleted',
            'ext' => 'Extension',
            'size' => 'Size',
            'date_create' => 'Date Created',
            'date_update' => 'Date Updated',
        ];
    }

    /**
     * Сохранение фото по заданному пути
     *
     * @param string $path
     * @return bool
     */
    public function savePhoto($path)
    {
        $this->photo = $path;
        return $this->save();
    }
}
