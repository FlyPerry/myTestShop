<?php

namespace app\controllers;

use app\models\User;
use app\models\UserInfo;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class UserController extends Controller
{
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

    /**
     * Действие отображения списка пользователей
     */
    public function actionIndex($active = 'dashboard')
    {
        $id = \Yii::$app->user->identity->id;
        $user = User::findOne($id);
        $userInfo = UserInfo::findOne(['user_id' => $id]);
        $this->tabs = array_replace($this->tabs, [$active => '1']);

        return $this->render('index', ['user' => $user, 'tabs' => $this->tabs, 'userInfo' => $userInfo]);
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
                $photoPath = 'uploads/' . $user->id . '_profile.' . $userInfo->photo->extension;
                $userInfo->photo->saveAs($photoPath);
                $userInfo->photo = $photoPath;
            }

            if ($user->validate() && $userInfo->validate()) {
                $user->save(false); // сохраняем без повторной валидации
                $userInfo->save(false);

                \Yii::$app->session->setFlash('success', 'Профиль успешно обновлён');
                return $this->redirect(['index', 'active' => 'profile']);
            }
        }

        return $this->render('profile', [
            'user' => $user,
            'userInfo' => $userInfo,
        ]);
    }
}

