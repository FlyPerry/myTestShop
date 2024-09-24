<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

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
 */
class Catalog extends \yii\db\ActiveRecord
{
    const VERIFY_REJECT = 0;
    const VERIFY_SUCCESS = 1;
    const VERIFY_PENDING = 2;

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
            [['user_id', 'category', 'name', 'date_create', 'date_update'], 'required'],
            [['user_id', 'category', 'verify', 'danger'], 'integer'],
            [['deleted'], 'boolean'],
            [['description'], 'string'],
            [['date_create', 'date_update'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'category' => 'Category',
            'name' => 'Name',
            'description' => 'Description',
            'deleted' => 'Deleted',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'verify' => 'Verify',
            'danger' => 'Danger',
            'categoryName' => 'Category Name', // Виртуальное поле
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
     * Виртуальное свойство для получения названия категории.
     * @return string|null
     */
    public function getCategoryName()
    {
        // Используем метод getCategory() для получения объекта категории
        $category = $this->getCategory()->one();
        return $category ? $category->name : null;
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
            $paths[] = Yii::getAlias('@webroot/uploads/user/' . $this->user_id . '/' . $this->id . '/' . $photo->photo);
        }
        return $paths;
    }

    public function getStatusVerify()
    {
        switch ($this->verify) {
            case $this::VERIFY_REJECT :
                return '<span class="badge bg-danger">Rejected</span>';
            case $this::VERIFY_SUCCESS :
                return '<span class="badge bg-success">Verified</span>';
            case $this::VERIFY_PENDING :
                return '<span class="badge bg-warning">Pending</span>';
            default:
                return '';
        }
    }
}
