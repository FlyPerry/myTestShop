<?php

namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class UserController extends Controller
{
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
    public function actionIndex()
    {
        return $this->render('index');
    }
}

