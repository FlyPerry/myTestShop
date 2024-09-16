<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\BaseHtml;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\RegisterForm;
use app\models\LoginForm;

AppAsset::register($this);
$registerModel = new RegisterForm();
$loginModel = new LoginForm();
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome --><!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.css" rel="stylesheet">
    <!-- jQuery, Popper.js и Bootstrap JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>TechSheld</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/site.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <?php
    if (Yii::$app->controller->id == 'admin') {
        echo Html::cssFile('@web/css/admin.css');
    }
    ?>
</head>
<body>
<!-- Header -->
<?php $cookies = Yii::$app->request->cookies;
if ($cookies->has('ChangedCity')): ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <?= Html::a('TechSheld', ['site/index'], ['class' => 'navbar-brand']); ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?= Html::a('Начальная страница', ['site/index'], ['class' => 'nav-link']); ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('Каталог', ['catalog/index'], ['class' => 'nav-link']); ?>
                </li>

                <!-- Dropdown for City Selection -->
                <!-- Dropdown for City Selection -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="cityDropdown" role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Город: Павлодар
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="cityDropdown">
                        <li><a class="dropdown-item" href="#">Москва</a></li>
                        <li><a class="dropdown-item" href="#">Санкт-Петербург</a></li>
                        <li><a class="dropdown-item" href="#">Алматы</a></li>
                        <li><a class="dropdown-item" href="#">Астана</a></li>
                    </ul>
                </li>

                <!-- Language Selection with Flags -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://flagcdn.com/16x12/ru.png" alt="Русский"> Русский
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        <li><a class="dropdown-item" href="#"><img src="https://flagcdn.com/16x12/ru.png" alt="Русский">
                                Русский</a></li>
                        <li><a class="dropdown-item" href="#"><img src="https://flagcdn.com/16x12/kz.png" alt="Қазақша">
                                Қазақша</a></li>
                    </ul>
                </li>


                <?php if (Yii::$app->user->isGuest): ?>
                    <!-- Login/Register Button with User Icon -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#authModal">
                            <i class="fa fa-user" aria-hidden="true"></i> Вход / Регистрация
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#authUserInfoModal">
                            <i class="fa fa-user" aria-hidden="true"></i> <?= Yii::$app->user->identity->getEmail() ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
<?php endif; ?>

<?php if (Yii::$app->user->isGuest): ?>

    <!-- Modal -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-centered" style="max-width: 30vw;">
            <div class="modal-content">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title" id="authModalLabel">Регистрация / Вход</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="authTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="register-tab" data-bs-toggle="tab" href="#register"
                               role="tab"
                               aria-controls="register" aria-selected="true">Регистрация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="login-tab" data-bs-toggle="tab" href="#login" role="tab"
                               aria-controls="login" aria-selected="false">Авторизация</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="register" role="tabpanel"
                             aria-labelledby="register-tab">
                            <?php $form = ActiveForm::begin([
                                'id' => 'registerForm',
                                'action' => ['site/register'],
                                'options' => ['class' => 'form'],
                            ]); ?>

                            <div class="mb-3">
                                <?= $form->field($registerModel, 'email')->textInput(['type' => 'email', 'class' => 'form-control'])->label('Эл.Почта') ?>
                            </div>
                            <div class="mb-3">
                                <?= $form->field($registerModel, 'password')->passwordInput(['class' => 'form-control'])->label('Пароль') ?>
                            </div>
                            <div class="mb-3">
                                <?= $form->field($registerModel, 'confirmPassword')->passwordInput(['class' => 'form-control'])->label('Подтвердите пароль') ?>
                            </div>

                            <div class="mb-3 text-end">
                                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary']) ?>
                                <?= Html::button('Закрыть', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                        <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
                            <?php $form = ActiveForm::begin([
                                'id' => 'loginForm',
                                'action' => ['site/login'],
                                'options' => ['class' => 'form'],
                            ]); ?>

                            <div class="mb-3">
                                <?= $form->field($loginModel, 'email')->textInput(['type' => 'email', 'class' => 'form-control'])->label('Эл.Почта') ?>
                            </div>
                            <div class="mb-3">
                                <?= $form->field($loginModel, 'password')->passwordInput(['class' => 'form-control'])->label('Пароль') ?>
                            </div>

                            <div class="mb-3 text-end">
                                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary']) ?>
                                <?= Html::button('Закрыть', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>

    <!-- Modal -->
    <div class="modal fade" id="authUserInfoModal" tabindex="-1" aria-labelledby="authUserInfoModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authUserInfoModalLabel">Информация о пользователе</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="https://placehold.co/100x100" class="rounded-circle mb-3"
                             alt="Profile picture of authenticated user with a neutral background">
                        <h4>AlexPolyakov</h4>
                        <p><?= Yii::$app->user->identity->getEmail(); ?></p>
                        <p><i class="fas fa-map-marker-alt"></i> Казахстан, Павлодар</p>
                    </div>
                    <hr>
                    <h5>Дополнительная информация</h5>
                    <ul class="list-unstyled">
                        <li><strong>Зарегестрирован:</strong> 15 Июля , 2024 г.</li>
                        <li><strong>Последняя авторизация:</strong> 25 Июля, 2024 г.</li>
                        <li><strong>Роль:</strong> ADMIN</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <?php if (Yii::$app->user->identity->getRole() == 1)
                        echo Html::a('Админ Панель', '/admin', ['class' => 'btn btn-info']);
                    ?>
                    <?= Html::a('Редактировать профиль', '/user/update', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Выйти', '/site/logout', ['class' => 'btn btn-danger', 'data-method' => 'post']) ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>


<!-- Optional: include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<main id="main" class="flex-shrink-0" role="main">
    <?php if (!empty($this->params['breadcrumbs'])): ?>
        <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
    <?php endif ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</main>
<?php
if ($cookies->has('ChangedCity') && (Yii::$app->controller->id !== 'admin')): ?>
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Store Location</h5>
                    <p>Address: 123 City</p>
                    <p>Phone: 7777777777</p>
                </div>
                <div class="col-md-4">
                    <h5>Shop</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Computers</a></li>
                        <li><a href="#" class="text-white">Tablets</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Customer Support</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<?php $this->endBody() ?>
<script>
    // Initialize Bootstrap tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
</body>
</html>
<?php $this->endPage() ?>
