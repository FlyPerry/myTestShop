<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Catalog;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $namekz
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
            [['name', 'namekz'], 'string', 'max' => 255],
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
            'namekz' => 'Category Name in Kazakh',
            'type' => 'Category Type',
        ];
    }

    /**
     * Геттер для динамического выбора имени в зависимости от языка.
     */
    public function getName()
    {
        // Проверка текущего языка приложения
        if (Yii::$app->language === 'kz-KZ' && !empty($this->namekz)) {
            return $this->namekz;
        }
        return $this->name;
    }

    public function getTranslatedType()
    {
        switch ($this->type) {
            case 'man':
                return Yii::t('app', 'beru');
            case 'women':
                return Yii::t('app', 'dayu');
            case 'work':
                return Yii::t('app', 'work');
            default:
                return $this->type; // В других случаях вернуть оригинальное значение
        }
    }

    public function getCountProducts()
    {
        $userRegion = Yii::$app->request->cookies->getValue('ChangedCity');
        $userDistrict = Yii::$app->request->cookies->getValue('ChangedDistrict');
        $countQuery = Catalog::find()->andWhere([
            'category' => $this->id,
            'deleted' => 0,
            'verify' => Catalog::VERIFY_SUCCESS
        ]);
        if ($userRegion != 0) {
            $countQuery->andWhere(['region' => $userRegion]);
        }
        if ($userDistrict != 0) {
            $countQuery->andWhere(['district' => $userDistrict]);
        }
        return $countQuery->count();
    }
}
