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

    public function actionMan($id = null)
    {
        return $this->renderCategoryPage('man', $id);
    }

    public function actionWomen($id = null)
    {
        return $this->renderCategoryPage('women', $id);
    }

    /**
     * Общий метод для рендеринга страниц категорий.
     *
     * @param string $type Тип категории (man или women)
     * @param int|null $id Идентификатор категории (опционально)
     * @return string
     */
    protected function renderCategoryPage($type, $id = null)
    {
        // Получение значений из cookies
        $userRegion = Yii::$app->request->cookies->getValue('ChangedCity');
        $userDistrict = Yii::$app->request->cookies->getValue('ChangedDistrict');

        $queryCategories = Category::find()
            ->where(['type' => $type])
            ->orderBy('name');

        // Получение категорий и создание списка идентификаторов
        $categoriesList = $queryCategories->all();
        $categoriesListArray = ArrayHelper::getColumn($categoriesList, 'id');

        // Получение записей каталога
        $catalogList = Catalog::find()
            ->where([
                'category' => $categoriesListArray,
                'deleted' => 0,
                'verify' => Catalog::VERIFY_SUCCESS,
            ]);

        if ($userRegion != 0) {
            $catalogList->andWhere(['region' => $userRegion]);
        }
        if ($userDistrict != 0) {
            $catalogList->andWhere(['district' => $userDistrict]);
        }
        if ($id !== null) {
            $catalogList->andWhere(['category' => $id]);
        }
        $catalogList = $catalogList->all();

        return $this->render('index', [
            'categoriesList' => $categoriesList,
            'catalogList' => $catalogList,
            'type' => $type,
        ]);
    }

    public function actionWork($id = NULL)
    {
        return $this->renderCategoryPage('work', $id);
    }

    public function actionProduct($id)
    {
        $productInfo = Catalog::findOne($id);
        return $this->render('product', ['productInfo' => $productInfo]);
    }
}
