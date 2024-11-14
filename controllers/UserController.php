<?php

namespace app\controllers;

use app\components\modal\selectCity\models\District;
use app\components\modal\selectCity\models\Region;
use app\models\Catalog;
use app\models\CatalogPhoto;
use app\models\Category;
use app\models\User;
use app\models\UserInfo;
use yii\db\StaleObjectException;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use Yii;
use yii\helpers\ArrayHelper;

class UserController extends Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $this->layout = 'user'; // Установка макета

            // Установка массива для доступа в макете
            Yii::$app->view->params['active'] = ['dashboard' => 0, 'profile' => 0, 'orders' => 0, 'sms' => 0, 'help' => 0];


            return true; // Позволяет выполнить действие
        }

        return false; // Прерывание выполнения действия
    }

    private $tabs = ['dashboard' => 0, 'profile' => 0, 'orders' => 0, 'sms' => 0, 'help' => 0];

    /**
     * Определение поведения контроллера
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Только для авторизованных пользователей
                    ],
                ],
            ],
        ];
    }

    public function actionDashboard()
    {
        Yii::$app->view->params['active'] = ['dashboard' => 'active'];

        return $this->render('dashboard', ['active' => ['dashboard' => 'active']]);
    }

    public function actionProfile()
    {
        Yii::$app->view->params['active'] = ['profile' => 'active'];

        $id = \Yii::$app->user->identity->id;
        $user = User::findOne($id);
        $userInfo = UserInfo::findOne(['user_id' => $id]);
        return $this->render('profile', [
            'user' => $user
            , 'tabs' => $this->tabs
            , 'userInfo' => $userInfo
        ]);
    }

    public function actionOrders()
    {
        Yii::$app->view->params['active'] = ['orders' => 'active'];

        $catalogList = Catalog::find()
            ->andWhere(['user_id' => Yii::$app->user->id])
            ->all();
        return $this->render('orders', [
            'catalogList' => $catalogList
        ]);
    }

    public function actionSms()
    {
        Yii::$app->view->params['active'] = ['sms' => 'active'];
        return $this->render('sms');
    }

    public function actionHelp()
    {
        Yii::$app->view->params['active'] = ['help' => 'active'];
        return $this->render('help');
    }

    public function actionProfileUpdate()
    {
        $id = \Yii::$app->user->identity->id;
        $user = User::findOne($id);
        $userInfo = UserInfo::findOne(['user_id' => $id]);

        if (!$user || !$userInfo) {
            throw new \yii\web\NotFoundHttpException('User not found');
        }

        // Сохраняем текущее значение фотографии перед загрузкой формы
        $currentPhoto = $userInfo->photo;

        if (\Yii::$app->request->isPost) {
            // Загружаем данные в модели
            $user->load(\Yii::$app->request->post());
            $userInfo->load(\Yii::$app->request->post());

            // Обработка фото (если загружено новое)
            $uploadedPhoto = UploadedFile::getInstance($userInfo, 'photo');
            if ($uploadedPhoto) {
                // Определение пути для сохранения фотографии
                $directoryPath = 'uploads/' . $user->id;
                $photoPath = $directoryPath . '/' . $user->id . '_profile.' . $uploadedPhoto->extension;

                // Проверка существования папки и создание при необходимости
                if (!is_dir($directoryPath)) {
                    mkdir($directoryPath, 0755, true); // Создание папки с правами 0755
                }

                // Сохранение фотографии
                if ($uploadedPhoto->saveAs($photoPath)) {
                    // Обновляем только если загрузка успешна
                    $userInfo->photo = $photoPath;
                }
            } else {
                // Если новое фото не загружено, оставляем старое значение
                $userInfo->photo = $currentPhoto;
            }

            // Проверка валидации и сохранение моделей
            if ($user->validate() && $userInfo->validate()) {
                $user->save(false); // сохраняем без повторной валидации
                $userInfo->save(false);

                \Yii::$app->session->setFlash('success', 'Профиль успешно обновлён');
                return $this->redirect(['user/profile']);
            }
        }

        return $this->render('profile', [
            'user' => $user,
            'userInfo' => $userInfo,
        ]);
    }

    public function actionUpload($catalogId)
    {
        $model = new CatalogPhoto();

        if (\Yii::$app->request->isPost) {
            $file = UploadedFile::getInstance($model, 'photo');
            if ($file) {
                $userId = \Yii::$app->user->id; // Получаем ID текущего пользователя
                $path = 'uploads/user/' . $userId . '/' . $catalogId;
                $filePath = $path . '/' . $file->baseName . '.' . $file->extension;

                // Создаём директорию, если она не существует
                if (!is_dir(\Yii::getAlias('@webroot/' . $path))) {
                    mkdir(\Yii::getAlias('@webroot/' . $path), 0777, true);
                }

                // Сохраняем файл
                if ($file->saveAs(\Yii::getAlias('@webroot/' . $filePath))) {
                    // Сохраняем информацию в базе данных
                    $model->catalogID = $catalogId;
                    $model->photo = $file->baseName . '.' . $file->extension;
                    $model->ext = $file->extension;
                    $model->size = $file->size;

                    if ($model->save()) {
                        return $this->redirect(['view', 'id' => $catalogId]);
                    }
                }
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    /**
     * @throws StaleObjectException
     * @throws \Throwable
     * @throws NotFoundHttpException
     */
    public function actionOrdersDelete($id)
    {
        // Найти запись по указанному ID
        $model = Catalog::findOne($id);

        // Проверка существования модели и совпадения пользователя
        if ($model === null || $model->user_id !== Yii::$app->user->id) {
            throw new \yii\web\NotFoundHttpException("Запись с ID {$id} не найдена или доступ к ней запрещен.");
        }


        // Попытка удалить модель
        try {
            $model->delete();
        } catch (StaleObjectException|\Throwable $e) {
            throw new \yii\web\NotFoundHttpException($e->getMessage());
        }
        // Удаление папки, если она существует
        $directory = Yii::getAlias('@app/web/uploads/catalog/' . $model->id);
        if (is_dir($directory)) {
            // Удаление папки и всех её содержимого
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CHILD_FIRST
            );
            foreach ($files as $fileinfo) {
                $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
                $todo($fileinfo->getRealPath());
            }
            rmdir($directory); // Удаляем саму папку
        }
        // Перенаправление после удаления
        return $this->redirect(['user/orders']);
    }

    public function actionOrdersCreate()
    {
        $model = new Catalog();
        $categories = Category::find()->all();
        $regions = Region::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Загружаем файлы изображений
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            $model->user_id = Yii::$app->user->id;

            // Сохраняем товар и фотографии
            if ($model->save() && $model->uploadPhotos()) {
                return $this->redirect(['user/orders']);
            }
        } else {
            // Вывести ошибки валидации для диагностики
            Yii::error($model->errors);
        }

        return $this->render('orders/create', ['model' => $model, 'categories' => $categories, 'regions' => $regions]);
    }

    public function actionGetDistrictsForRegion($region_id)
    {
        $districts = District::find()->where(['region_id' => $region_id])->asArray()->all();
        $result = [];
        foreach ($districts as $district) {
            $result[] = ['id' => $district['id'], 'name' => $district['name']];
        }
        return \yii\helpers\Json::encode($result);

    }


    public function actionOrdersUpdate($id)
    {
        // Находим модель по ID
        $model = Catalog::findOne($id);
        $categories = Category::find()->andWhere(['type' => $model->getCategory()->one()->type])->all();

        // Проверяем, существует ли модель
        if (!$model) {
            throw new NotFoundHttpException('Запись не найдена.');
        }

        // Если форма отправлена
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Обработка загруженных фотографий
            $model->date_update = date('Y-m-d H:i:s'); // Обновляем дату изменения
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            $model->user_id = Yii::$app->user->id;
            $model->verify = Catalog::VERIFY_PENDING;
            CatalogPhoto::deleteAll(['catalogID' => $model->id]);
            $directory = Yii::getAlias('@app/web/uploads/catalog/' . $model->id);
            if (is_dir($directory)) {
                // Удаление папки и всех её содержимого
                $files = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS),
                    \RecursiveIteratorIterator::CHILD_FIRST
                );
                foreach ($files as $fileinfo) {
                    $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
                    $todo($fileinfo->getRealPath());
                }
                rmdir($directory); // Удаляем саму папку
            }
            if ($model->save() && $model->uploadPhotos()) {
                // Загрузка и сохранение фотографий, если они были выбраны
                return $this->redirect(['user/orders']);
            }
        }

        if ($model->user_id === Yii::$app->user->id) {
            return $this->render('orders/update', [
                'model' => $model, 'categories' => $categories,
            ]);
        }
        return $this->redirect(['orders']);
    }
}

