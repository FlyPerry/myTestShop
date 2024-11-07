<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\Catalog;

class AdminController extends Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            // Check user role and redirect if needed
            if (Yii::$app->user->isGuest || Yii::$app->user->identity->getRole() != 1) {
                Yii::$app->response->redirect(['site/index']);
                return false;
            }
            $this->layout = 'admin'; // Установка макета

            // Установка массива для доступа в макете
            Yii::$app->view->params['active'] = ['catalog' => 0, 'moderate' => 0, 'statistics' => 0];

            return true;
        }
        return false;
    }

    public function behaviors()
    {
        return [
            // Define access control behavior
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['index', 'view', 'create', 'update', 'delete'], // Actions that need access control
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Only authenticated users
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->getRole() == 1;
                        },
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->redirect(['admin/moderate']);
    }

    public function actionModerate()
    {
        $itemsForModerate = Catalog::find()->andWhere(['deleted' => false, 'verify' => Catalog::VERIFY_PENDING])->all();
        return $this->render('moderate', ['itemsForModerate' => $itemsForModerate]);
    }

    public function actionModerateCancel($id)
    {
        // Ищем товар по id
        $product = Catalog::findOne($id);

        if ($product === null) {
            throw new NotFoundHttpException("Товар не найден.");
        }

        // Отменяем статус модерации (например, статус "ожидает модерации")
        $product->verify = Catalog::VERIFY_REJECT;  // VERIFY_REJECT - статус для товаров, которые ещё не подтверждены
        if ($product->save()) {
            Yii::$app->session->setFlash('success', 'Модерация отменена.');
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка при отмене модерации.');
        }

        // Перенаправляем на страницу модерации
        return $this->redirect(['admin/moderate']);
    }

    public function actionModerateAccept($id)
    {
        // Ищем товар по id
        $product = Catalog::findOne($id);

        if ($product === null) {
            throw new NotFoundHttpException("Товар не найден.");
        }

        // Отменяем статус модерации (например, статус "ожидает модерации")
        $product->verify = Catalog::VERIFY_SUCCESS;  // VERIFY_REJECT - статус для товаров, которые ещё не подтверждены
        if ($product->save()) {
            Yii::$app->session->setFlash('success', 'Модерация отменена.');
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка при отмене модерации.');
        }

        // Перенаправляем на страницу модерации
        return $this->redirect(['admin/moderate']);
    }
    public function actionView($id)
    {
        // Implement the view action
        // For example:
        // $model = $this->findModel($id);
        // return $this->render('view', ['model' => $model]);
    }

    public function actionCreate()
    {
        // Implement the create action
    }

    public function actionUpdate($id)
    {
        // Implement the update action
    }

    public function actionDelete($id)
    {
        // Implement the delete action
    }

    protected function findModel($id)
    {
        // Implement the method to find a model
        // For example:
        // if (($model = Model::findOne($id)) !== null) {
        //     return $model;
        // }
        // throw new NotFoundHttpException('The requested page does not exist.');
    }


}
