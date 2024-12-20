<?php

namespace app\models;

use app\components\modal\selectCity\models\District;
use app\components\modal\selectCity\models\Region;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "catalog".
 *
 * @property int $id
 * @property int $user_id
 * @property int $category
 * @property string $name
 * @property string|null $description
 * @property int|null $deleted
 * @property string $date_create
 * @property string $date_update
 * @property int|null $verify
 * @property int|null $danger
 * @property string|null $categoryName Виртуальное свойство для названия категории
 * @property string|null $regionName
 */
class Catalog extends \yii\db\ActiveRecord
{
    const VERIFY_REJECT = 0; //отклонённые
    const VERIFY_SUCCESS = 1; // подтверждённые
    const VERIFY_PENDING = 2; // на модерации
    public $imageFiles;

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
            [['user_id', 'category', 'name'], 'required'],
            [['user_id', 'category', 'verify', 'district', 'region', 'danger'], 'integer'],
            [['deleted'], 'boolean'],
            [['description'], 'string'],
            [['date_create', 'date_update'], 'safe'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 10],
            [['name', 'youtubeLink'], 'string', 'max' => 255], // Добавлено поле youtubeLink
            [['youtubeLink'], 'url', 'message' => 'Введите корректную ссылку на YouTube'], // Валидация YouTube ссылки
            [['youtubeLink'], 'validateYoutubeLink'], // Кастомная валидация для YouTube ссылки
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => Yii::t('app', 'user'),
            'category' => Yii::t('app', 'category'),
            'name' => Yii::t('app', 'name'),
            'description' => Yii::t('app', 'description'),
            'deleted' => Yii::t('app', 'deleted'),
            'date_create' => Yii::t('app', 'date_create'),
            'date_update' => Yii::t('app', 'date_update'),
            'verify' => Yii::t('app', 'verify'),
            'danger' => Yii::t('app', 'danger'),
            'youtubeLink' => Yii::t('app', 'youtubeLink'),
            'categoryName' => Yii::t('app', 'categoryName'),
        ];
    }

    /**
     * Связь с пользователем
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Связь с категорией
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category']);
    }

    /**
     **
     * Виртуальное свойство для получения названия категории в зависимости от языка.
     * @return string|null
     */
    public function getCategoryName()
    {
        $category = $this->getCategory()->one();
        if ($category) {
            return Yii::$app->language === 'kz-KZ' ? $category->namekz : $category->name;
        }
        return null;
    }

    public function getUrlCategoryTypeBreadcrumb()
    {
        return Url::to('/catalog/' . $this->getCategory()->one()->type);
    }

    public function getUrlCategoryBreadcrumb()
    {
        return Url::to($this->getUrlCategoryTypeBreadcrumb() . '/' . $this->category);
    }


    function getFinishUrl()
    {
        return Url::to('/catalog/product/' . $this->id);
    }

    /**
     * Получение фотографий для каталога
     *
     * @return array|CatalogPhoto[]
     */
    public function getPhotos()
    {
        if ($this->id === null) {
            return []; // Возвращаем пустой массив, если ID не установлен
        }

        return CatalogPhoto::find()->where(['catalogID' => $this->id, 'deleted' => 0])->all();
    }

    /**
     * Получение путей к фотографиям
     *
     * @return array
     */
    public function getPhotoPaths()
    {
        $photos = $this->getPhotos();
        $paths = [];
        foreach ($photos as $photo) {
            $paths [] = '/' . $photo->photo;
        }
        return $paths;
    }

    public function validateYoutubeLink($attribute, $params, $validator)
    {
        if (!$this->hasErrors()) {
            $pattern = '/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/i';
            if (!preg_match($pattern, $this->$attribute)) {
                $this->addError($attribute, 'Некорректная ссылка на YouTube.');
            }
        }
    }

    public function getStatusVerify()
    {
        switch ($this->verify) {
            case self::VERIFY_REJECT:
                return '<span class="badge bg-danger">' . Yii::t('app', 'rejected') . '</span>';
            case self::VERIFY_SUCCESS:
                return '<span class="badge bg-success">' . Yii::t('app', 'verified') . '</span>';
            case self::VERIFY_PENDING:
                return '<span class="badge bg-warning">' . Yii::t('app', 'pending') . '</span>';
            default:
                return '';
        }
    }

    public function uploadPhotos()
    {
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $filePath = 'uploads/catalog/' . $this->id . '/' . $file->baseName . '.' . $file->extension;

                // Создаем директорию, если она не существует
                if (!is_dir(dirname($filePath))) {
                    mkdir(dirname($filePath), 0777, true);
                }

                // Сохраняем файл на сервер
                if ($file->saveAs($filePath)) {
                    // Создаем запись в таблице catalogPhoto
                    $photo = new CatalogPhoto();
                    $photo->catalogID = $this->id;
                    $photo->photo = $filePath;
                    $photo->active = 1;
                    $photo->verify = 0;
                    $photo->deleted = 0;
                    $photo->ext = $file->extension;
                    $photo->size = $file->size;
                    $photo->save();
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public static function getYoutubeLink()
    {
        return true;
    }
    /**
     * Связь с районом (district)
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::class, ['id' => 'district']);
    }

    /**
     * Связь с регионом (region)
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'region']);
    }
    /**
     * Виртуальное свойство для названия района
     * @return string|null
     */
    public function getDistrictName()
    {
        $district = $this->getDistrict()->one();
        return $district ? $district->name : null;
    }

    /**
     * Виртуальное свойство для названия региона
     * @return string|null
     */
    public function getRegionName()
    {
        $region = $this->getRegion()->one();
        return $region ? $region->name : null;
    }

}
