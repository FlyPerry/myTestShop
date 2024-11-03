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
        $catalog =  new Catalog;
        $strict = $catalog::find()->all();
        return $this->render('index',['catalog'=>$catalog]);
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

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            // Check user role and redirect if needed
            if (Yii::$app->user->isGuest || Yii::$app->user->identity->getRole() != 1) {
                Yii::$app->response->redirect(['site/index']);
                return false;
            }
            return true;
        }
        return false;
    }
}
