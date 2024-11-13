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
use app\models\UserInfo;
use app\components\modal\selectCity\SelectCity;

AppAsset::register($this);
$registerModel = new RegisterForm();
$loginModel = new LoginForm();
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$active = Yii::$app->view->params['active'];

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all"
          rel="stylesheet" type="text/css"/>
    <title>Asar Club</title>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/buffer.min.js"
            type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/filetype.min.js"
            type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js"
            type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js"
            type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/locales/ru.js"></script>
    <link href="/css/site.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <?= Html::cssFile('@web/css/' . Yii::$app->controller->id . '.css'); ?>
</head>
<body>

<!-- Header -->
<?php $cookies = Yii::$app->request->cookies;
if ($cookies->has('ChangedCity')): ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <?= Html::a('Asar Club', ['/'], ['class' => 'navbar-brand']); ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?= Html::a(Yii::t('app', 'main-page'), ['/'], ['class' => 'nav-link']); ?>
                </li>

                <!-- Dropdown for City Selection -->
                <li class="nav-item">
                    <button class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#locationModal">
                        <?= Yii::t('app', 'city-place') ?>: <span id="cityName">Нас. Пункт</span>
                    </button>
                </li>

                <!-- Language Selection with Flags -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if (Yii::$app->language === 'ru-RU'): ?>
                            <img src="https://flagcdn.com/16x12/ru.png" alt="Русский" class="me-2"> Русский
                        <?php elseif (Yii::$app->language === 'kz-KZ'): ?>
                            <img src="https://flagcdn.com/16x12/kz.png" alt="Қазақша" class="me-2"> Қазақша
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        <li>
                            <a class="dropdown-item <?= Yii::$app->language === 'ru-RU' ? 'active' : '' ?>"
                               href="<?= \yii\helpers\Url::to(['site/change-language', 'lang' => 'ru-RU']) ?>">
                                <img src="https://flagcdn.com/16x12/ru.png" alt="Русский" class="me-2"> Русский
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item <?= Yii::$app->language === 'kz-KZ' ? 'active' : '' ?>"
                               href="<?= \yii\helpers\Url::to(['site/change-language', 'lang' => 'kz-KZ']) ?>">
                                <img src="https://flagcdn.com/16x12/kz.png" alt="Қазақша" class="me-2"> Қазақша
                            </a>
                        </li>
                    </ul>
                </li>


                <?php if (Yii::$app->user->isGuest): ?>
                    <!-- Login/Register Button with User Icon -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#authModal">
                            <i class="fa fa-user" aria-hidden="true"></i> <?= Yii::t('app', 'login') ?>
                            / <?= Yii::t('app', 'register') ?>
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
                    <h5 class="modal-title" id="authModalLabel"><?= Yii::t('app', 'register') ?>
                        / <?= Yii::t('app', 'login') ?></h5>
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
                        <div class="tab-pane fade show active mt-3" id="register" role="tabpanel"
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
                        <div class="tab-pane fade mt-3" id="login" role="tabpanel" aria-labelledby="login-tab">
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
                    <h5 class="modal-title" id="authUserInfoModalLabel"><?= Yii::t('app', 'info-about-user') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="<?= UserInfo::findOne(Yii::$app->user->identity->id)->getPhoto(); ?>"
                             class="profile-picture m-auto rounded-circle mb-3"
                             alt="Profile picture of authenticated user with a neutral background">
                        <h4><?= Yii::$app->user->identity->getLastname() . ' ' . Yii::$app->user->identity->getFirstname() ?></h4>
                        <p><?= Yii::$app->user->identity->getEmail(); ?></p>
                    </div>
                    <hr>
                </div>
                <div class="modal-footer">
                    <?php if (Yii::$app->user->identity->getRole() == 1)
                        echo Html::a(Yii::t('app', 'admin-panel'), '/admin', ['class' => 'btn btn-info']);
                    ?>
                    <?= Html::a(Yii::t('app','personal-cabinet'), '/user/profile', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'exit'), '/site/logout', ['class' => 'btn btn-danger', 'data-method' => 'post']) ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<main id="main" class="flex-shrink-0" role="main">
    <?php if (!empty($this->params['breadcrumbs'])): ?>
        <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
    <?php endif ?>
    <?= Alert::widget() ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Кнопка для открытия бокового меню на мобильных устройствах -->
            <div class="d-md-none col-12 text-end mb-3">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu">
                    <i class="fas fa-bars"></i> Меню
                </button>
            </div>

            <!-- Боковое меню: Offcanvas на мобильных устройствах, фиксированное на ПК -->
            <div class="col-md-3 col-lg-2 bg-dark sidebar offcanvas-md offcanvas-start" id="sidebarMenu" tabindex="-1"
                 aria-labelledby="sidebarMenuLabel">
                <div class="offcanvas-header d-md-none"> <!-- Заголовок и кнопка закрытия только на мобильных -->
                    <h5 class="offcanvas-title text-white" id="sidebarMenuLabel"><?=Yii::t('app', 'personal-cabinet')?></h5>
                    <button type="button" class="btn-close bg-white btn-close-white" id="canvasClose"
                            data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="/user/dashboard"
                               class="nav-link <?= isset($active['dashboard']) ? $active['dashboard'] : '' ?>">
                                <i class="fa-solid fa-table-list"></i> <?=Yii::t('app', 'infPanel')?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/user/profile"
                               class="nav-link <?= isset($active['profile']) ? $active['profile'] : '' ?>"><i
                                        class="fa-regular fa-id-badge"></i> <?=Yii::t('app', 'myProfile')?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/user/orders"
                               class="nav-link <?= isset($active['orders']) ? $active['orders'] : '' ?>"><i
                                        class="fa-solid fa-bars-staggered"></i> <?=Yii::t('app', 'sendOrder')?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/user/sms" class="nav-link <?= isset($active['sms']) ? $active['sms'] : '' ?>"><i
                                        class="fas fa-envelope"></i> <?=Yii::t('app', 'sms')?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/user/help"
                               class="nav-link <?= isset($active['help']) ? $active['help'] : '' ?>"><i
                                        class="fas fa-question-circle"></i> <?=Yii::t('app', 'help')?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('<i class="fa-solid fa-person-walking-arrow-right"></i> '.Yii::t('app', 'exit'), '/site/logout', ['class' => 'nav-link', 'data-method' => 'post']) ?>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Основной контент -->
            <div class="col-md-9 col-lg-10 content tab-content">
                <?= $content ?>
            </div>
        </div>
    </div>
</main>


<?php
if ($cookies->has('ChangedCity') && (Yii::$app->controller->id !== 'admin')): ?>
    <?= $this->render('footer.php'); ?>
<?php endif; ?>

<?= SelectCity::widget(); ?>

<?php $this->endBody() ?>
<script>
    // Initialize Bootstrap tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
<script>

    // Данные районов и микрорайонов по областям
    <?php
    $regionName = (new SelectCity())->getRegion($cookies->getValue('ChangedCity'));
    $districtName = (new SelectCity())->getDistrict($cookies->getValue('ChangedDistrict'));
    $cityName = (new SelectCity())->getCity($cookies->getValue('ChangedNeighborhood'));

    ?>
    $(document).ready(function () {
        $('#cityName').text(`<?=$regionName.' | '.$districtName?>`);

        let sidebarOffcanvas = new bootstrap.Offcanvas(document.getElementById('sidebarMenu'));
        $('#canvasClose').on('click', function () {
            sidebarOffcanvas.hide();
        });
    });
</script>
</body>
</html>

<?php $this->endPage() ?>
