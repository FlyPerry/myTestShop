<?php

namespace app\controllers;

use app\models\Catalog;
use app\models\CatalogPhoto;
use app\models\User;
use app\models\UserInfo;
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

    public function actionUpdate()
    {
        $id = \Yii::$app->user->identity->id;
        $user = User::findOne($id);
        $userInfo = UserInfo::findOne(['user_id' => $id]);

        if (!$user || !$userInfo) {
            throw new \yii\web\NotFoundHttpException('User not found');
        }

        if (\Yii::$app->request->isPost) {
            $user->load(\Yii::$app->request->post());
            $userInfo->load(\Yii::$app->request->post());

            // Обработка фото (если загружено новое)
            $userInfo->photo = UploadedFile::getInstance($userInfo, 'photo');
            if ($userInfo->photo) {
                // Определение пути для сохранения фотографии
                $directoryPath = 'uploads/' . $user->id;
                $photoPath = $directoryPath . '/' . $user->id . '_profile.' . $userInfo->photo->extension;

                // Проверка существования папки и создание при необходимости
                if (!is_dir($directoryPath)) {
                    mkdir($directoryPath, 0755, true); // Создание папки с правами 0755
                }

                // Сохранение фотографии
                $userInfo->photo->saveAs($photoPath);
                $userInfo->photo = $photoPath;
            }

            if ($user->validate() && $userInfo->validate()) {
                $user->save(false); // сохраняем без повторной валидации
                $userInfo->save(false);

                \Yii::$app->session->setFlash('success', 'Профиль успешно обновлён');
                return $this->redirect(['profile']);
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

    public function actionChangeActiveOrder()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $id = \Yii::$app->request->post('id');
        $product = Catalog::findOne($id);

        if ($product === null) {
            throw new NotFoundHttpException('Продукт не найден.');
        }

        // Меняем статус активности
        $product->deleted = !$product->deleted;

        // Сохраняем и возвращаем результат
        if ($product->save()) {
            return [
                'success' => true,
                'deleted' => $product->deleted
            ];
        } else {
            return [
                'success' => false,
                'errors' => $product->errors
            ];
        }
    }

    public function actionOrdersUpdate($id)
    {
        // Находим модель по ID
        $model = Catalog::findOne($id);

        // Проверяем, существует ли модель
        if (!$model) {
            throw new NotFoundHttpException('Запись не найдена.');
        }

        // Если форма отправлена
        if ($model->load(Yii::$app->request->post())) {
            // Обработка загруженных фотографий
            $model->date_update = date('Y-m-d H:i:s'); // Обновляем дату изменения

            if ($model->save()) {
                // Загрузка и сохранение фотографий, если они были выбраны
                $photos = UploadedFile::getInstancesByName('photos'); // Имя должно совпадать с именем в форме

                foreach ($photos as $photo) {
                    $catalogPhoto = new CatalogPhoto();
                    $catalogPhoto->catalogID = $model->id;
                    $catalogPhoto->photo = $photo->baseName . '.' . $photo->extension;
                    $catalogPhoto->ext = $photo->extension;
                    $catalogPhoto->size = $photo->size;

                    // Путь для сохранения
                    $path = 'uploads/user/' . $model->user_id . '/' . $model->id . '/' . $catalogPhoto->photo;
                    $photo->saveAs($path);

                    // Сохраняем информацию о фотографии
                    $catalogPhoto->save();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('orders/update', [
            'model' => $model,
        ]);
    }
}

