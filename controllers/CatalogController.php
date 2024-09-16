<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class CatalogController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'checkCookie' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            // Проверяем наличие куки 'ChangedCity'
                            return Yii::$app->request->cookies->has('ChangedCity');
                        },
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    // Если куки нет, перенаправляем на главную страницу или другую страницу
                    return $this->redirect('/');
                },
            ],
        ];
    }

    /**
     * Displays catalog page.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionProduct($id = 0){
        return $this->render('product');
    }
}
