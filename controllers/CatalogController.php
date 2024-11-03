<?php

namespace app\controllers;

use app\models\Catalog;
use app\models\Category;
use Yii;
use yii\helpers\ArrayHelper;
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
        return $this->redirect('/');
    }

    public function actionMan($id = NULL)
    {
        $queryCategories = Category::find()->andWhere(['type' => 'man'])->orderBy('name');
        $categoriesList = $queryCategories->all();
        if (!is_null($id)) {
            $queryCategories->andWhere(['id' => $id]);
        }
        $categoriesFilter = $queryCategories->all();
        $categoriesListArray = ArrayHelper::getColumn($categoriesFilter, 'id');

        $catalogList = Catalog::find()->andWhere(['category' => $categoriesListArray,'deleted'=>0])->all();
        return $this->render('index', ['categoriesList' => $categoriesList, 'catalogList' => $catalogList,'type'=>'man']);
    }

    public function actionWomen($id = NULL)
    {
        $queryCategories = Category::find()->andWhere(['type' => 'women'])->orderBy('name');
        $categoriesList = $queryCategories->all();
        if (!is_null($id)) {
            $queryCategories->andWhere(['id' => $id]);
        }
        $categoriesFilter = $queryCategories->all();
        $categoriesListArray = ArrayHelper::getColumn($categoriesFilter, 'id');

        $catalogList = Catalog::find()->andWhere(['category' => $categoriesListArray,'deleted'=>0])->all();
        return $this->render('index', ['categoriesList' => $categoriesList, 'catalogList' => $catalogList,'type'=>'women']);
    }

    public function actionProduct($id)
    {
        $productInfo = Catalog::findOne($id);
        return $this->render('product',['productInfo'=>$productInfo]);
    }
}
