<?php

namespace app\controllers;

use app\models\RegisterForm;
use Yii;
use yii\web\Controller;
use yii\web\Cookie;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Проверяем наличие куки "ChangedCity"
        $cookies = Yii::$app->request->cookies;
        if (!$cookies->has('ChangedCity')) {
            // Если куки нет, показываем шаблон first-enter
            return $this->render('selectCity');
        }

        // Если куки существует, выводим стандартную домашнюю страницу


        return $this->render('index');
    }

    public function actionChangeLanguage($lang)
    {
        // Проверяем, поддерживается ли язык
        if (in_array($lang, ['ru-RU', 'kz-KZ'])) {
            Yii::$app->language = $lang;

            // Устанавливаем куки для языка
            $cookie = new \yii\web\Cookie([
                'name' => 'language',
                'value' => $lang,
                'expire' => time() + 86400 * 30, // Кука на 30 дней
            ]);
            Yii::$app->response->cookies->add($cookie);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionSubmitChangedCity()
    {

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->request->isPost) {
            $city = Yii::$app->request->post('city');
            $district = Yii::$app->request->post('district');
            $neighborhood = Yii::$app->request->post('neighborhood');

            // Сохраняем данные в куки
            $cookies = Yii::$app->response->cookies;

            // Добавляем куку для города
            $cookies->add(new \yii\web\Cookie([
                'name' => 'ChangedCity',
                'value' => $city?:0,
                'expire' => time() + 86400 * 365, // 1 год
            ]));

            // Добавляем куку для района
            $cookies->add(new \yii\web\Cookie([
                'name' => 'ChangedDistrict',
                'value' => $district?:0,
                'expire' => time() + 86400 * 365, // 1 год
            ]));

            // Добавляем куку для микрорайона
            $cookies->add(new \yii\web\Cookie([
                'name' => 'ChangedNeighborhood',
                'value' => $neighborhood?:0,
                'expire' => time() + 86400 * 365, // 1 год
            ]));

            return ['success' => true];
        }

        return ['success' => false];
    }

    // Registration action
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/index']);
        }else{
            Yii::$app->session->setFlash('error', Yii::t('app','errorLogin'));
        }

        return $this->render('index');
    }

    public function actionRegister()
    {
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->redirect(['user/profile']);
        }

        return $this->render('index');
    }

    /**
     * Логика выхода пользователя
     * @return Response
     */
    public function actionLogout()
    {
        // Проверяем, авторизован ли пользователь
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        // Выполняем выход
        Yii::$app->user->logout();

        // Перенаправляем пользователя на главную страницу или любую другую
        return $this->goHome();
    }

}
