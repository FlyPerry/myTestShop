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
                        <?= Yii::t('app', 'city-place') ?>: <span id="cityName">Павлодар</span>
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
                    <h5 class="modal-title" id="authUserInfoModalLabel">Информация о пользователе</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="<?= UserInfo::findOne(Yii::$app->user->identity->id)->getPhoto(); ?>"
                             class="profile-picture m-auto rounded-circle mb-3"
                             alt="Profile picture of authenticated user with a neutral background">
                        <h4><?= Yii::$app->user->identity->getLastname() . ' ' . Yii::$app->user->identity->getFirstname() ?></h4>
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
                    <?= Html::a('Личный кабинет', '/user/dashboard', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Выйти', '/site/logout', ['class' => 'btn btn-danger', 'data-method' => 'post']) ?>
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
                    <h5 class="offcanvas-title text-white" id="sidebarMenuLabel">Личный кабинет</h5>
                    <button type="button" class="btn-close bg-white btn-close-white" id="canvasClose"
                            data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="/user/dashboard"
                               class="nav-link <?= isset($active['dashboard']) ? $active['dashboard'] : '' ?>">
                                <i class="fa-solid fa-table-list"></i> Инф. Панель
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/user/profile"
                               class="nav-link <?= isset($active['profile']) ? $active['profile'] : '' ?>"><i
                                        class="fa-regular fa-id-badge"></i> Мой профиль</a>
                        </li>
                        <li class="nav-item">
                            <a href="/user/orders"
                               class="nav-link <?= isset($active['orders']) ? $active['orders'] : '' ?>"><i
                                        class="fa-solid fa-bars-staggered"></i> Мои товары</a>
                        </li>
                        <li class="nav-item">
                            <a href="/user/sms" class="nav-link <?= isset($active['sms']) ? $active['sms'] : '' ?>"><i
                                        class="fas fa-envelope"></i> Сообщения</a>
                        </li>
                        <li class="nav-item">
                            <a href="/user/help"
                               class="nav-link <?= isset($active['help']) ? $active['help'] : '' ?>"><i
                                        class="fas fa-question-circle"></i> Помощь</a>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('<i class="fa-solid fa-person-walking-arrow-right"></i> Выйти', '/site/logout', ['class' => 'nav-link', 'data-method' => 'post']) ?>
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
<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-centered" style="max-width: 80%;">
        <div class="modal-content">
            <!--            <div class="modal-header">-->
            <!--                <h5 class="modal-title" id="locationModalLabel">-->
            <?php //=Yii::t('app', 'select-location')?><!--</h5>-->
            <!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            <!--            </div>-->
            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control"
                           placeholder="<?= Yii::t('app', 'find-location-placeholder') ?>">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <div class="row">
                    <!-- City Selection -->
                    <div class="col-4">
                        <select class="form-select" size="10" id="city-select">
                            <option value="0">Весь Казахстан</option>
                            <option value="1">Алматинская область</option>
                            <option value="2">Акмолинская область</option>
                            <option value="3">Актюбинская область</option>
                            <option value="4">Атырауская область</option>
                            <option value="5">Восточно-Казахстанская область</option>
                            <option value="6">Жамбылская область</option>
                            <option value="7">Западно-Казахстанская область</option>
                            <option value="8">Карагандинская область</option>
                            <option value="9">Костанайская область</option>
                            <option value="10">Кызылординская область</option>
                            <option value="11">Мангистауская область</option>
                            <option value="12">Павлодарская область</option>
                            <option value="13">Северо-Казахстанская область</option>
                            <option value="14">Туркестанская область</option>
                            <option value="15">Жетысуская область</option>
                        </select>
                    </div>
                    <!-- District Selection (initially hidden) -->
                    <div class="col-4 d-none" id="district-container">
                        <select class="form-select" size="10" id="district-select">
                            <option value="0">Все районы</option>
                            <!-- Динамически добавляемые районы -->
                        </select>
                    </div>
                    <!--                         Neighborhood Selection (initially hidden) -->
                    <div class="col-4 d-none" id="neighborhood-container">
                        <select class="form-select" size="10" id="neighborhood-select">
                            <option value="0">Все микрорайоны</option>
                            <!--                            Динамически добавляемые микрорайоны-->
                        </select>
                    </div>
                </div>
                <div class="mt-3 text-end">
                    <button class="btn btn-primary changeCityBtn"><?= Yii::t('app', 'select') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

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
    const data = {
        "1": { // Алматинская область
            districts: [
                {id: "1", name: "Алатауский район"},
                {id: "2", name: "Алмалинский район"},
                {id: "3", name: "Ауэзовский район"},
                {id: "4", name: "Бостандыкский район"},
                {id: "5", name: "Жетысуский район"},
                {id: "6", name: "Медеуский район"},
                {id: "7", name: "Наурызбайский район"},
                {id: "8", name: "Турксибский район"},
                {id: "8", name: "Талдыкорган"},
                {id: "8", name: "Капшагай"},
                {id: "8", name: "Текели"},
            ]
        },
        "2": { // Акмолинская область
            districts: [
                {id: "1", name: "Аккольский район"},
                {id: "2", name: "Аршалынский район"},
                {id: "3", name: "Астраханский район"},
                {id: "4", name: "Атбасарский район"},
                {id: "5", name: "Буландынский район"},
                {id: "6", name: "Бурабайский район"},
                {id: "7", name: "Егиндыкольский район"},
                {id: "8", name: "Ерейментауский район"},
                {id: "9", name: "Есильский район"},
                {id: "10", name: "Жаксынский район"},
                {id: "11", name: "Коргалжынский район"},
                {id: "12", name: "Сандыктауский район"},
                {id: "13", name: "Целиноградский район"},
                {id: "14", name: "Шортандинский район"},
                {id: "15", name: "Кокшетау"},
                {id: "16", name: "Степногорск"},
            ]
        },
        "3": { // Актюбинская область
            districts: [
                {id: "1", name: "Айтекебийский район"},
                {id: "2", name: "Алгинский район"},
                {id: "3", name: "Байганинский район"},
                {id: "4", name: "Иргизский район"},
                {id: "5", name: "Каргалинский район"},
                {id: "6", name: "Кобдинский район"},
                {id: "7", name: "Мартукский район"},
                {id: "8", name: "Мугалжарский район"},
                {id: "9", name: "Темирский район"},
                {id: "10", name: "Уилский район"},
                {id: "11", name: "Хромтауский район"},
                {id: "12", name: "Сандыктауский район"},
                {id: "13", name: "Целиноградский район"},
                {id: "14", name: "Шортандинский район"},
                {id: "15", name: "Актобе"},
                {id: "16", name: "Кандыагаш"},
            ]
        },
        "4": { // Атырауская область
            districts: [
                {id: "1", name: "Индерский район"},
                {id: "2", name: "Исатайский район"},
                {id: "3", name: "Курмангазинский район"},
                {id: "4", name: "Макатский район"},
                {id: "5", name: "Махамбетский район"},
                {id: "6", name: "Атырау"},
                {id: "7", name: "Кульсары"},
            ]
        },
        "5": { // Восточно-Казахстанская область
            districts: [
                {id: "1", name: "Абайский район"},
                {id: "2", name: "Аягозский район"},
                {id: "3", name: "Бескарагайский район"},
                {id: "4", name: "Бородулихинский район"},
                {id: "5", name: "Глубоковский район"},
                {id: "6", name: "Жарминский район"},
                {id: "7", name: "Зайсанский район"},
                {id: "8", name: "Зыряновский район"},
                {id: "9", name: "Катон-Карагайский район"},
                {id: "10", name: "Кокпектинский район"},
                {id: "11", name: "Тарбагатайский район"},
                {id: "12", name: "Уланский район"},
                {id: "13", name: "Усть-Каменогорск"},
                {id: "14", name: "Семей"},
                {id: "15", name: "Риддер"},
            ]
        },
        "6": { // Жамбылская область
            districts: [
                {id: "1", name: "Байзакский район"},
                {id: "2", name: "Жамбылский район"},
                {id: "3", name: "Жуалынский район"},
                {id: "4", name: "Кордайский район"},
                {id: "5", name: "Меркенский район"},
                {id: "6", name: "Мойынкумский район"},
                {id: "7", name: "Рыскуловский район"},
                {id: "8", name: "Сарысуский район"},
                {id: "9", name: "Таласский район"},
                {id: "10", name: "Тараз "},
                {id: "11", name: "Жанатас"},
                {id: "12", name: "Каратау"},
            ]
        },
        "7": { // Западно-Казахстанская область
            districts: [
                {id: "1", name: "Акжаикский район"},
                {id: "2", name: "Бокейординский район"},
                {id: "3", name: "Жангалинский район"},
                {id: "4", name: "Каратобинский район"},
                {id: "5", name: "Сырымский район"},
                {id: "6", name: "Таскалинский район"},
                {id: "7", name: "Теректинский район"},
                {id: "8", name: "Шынгырлауский район"},
                {id: "9", name: "Уральск"},
                {id: "10", name: "Аксай"},
            ]
        },
        "8": { // Карагандинская область
            districts: [
                {id: "1", name: "Абайский район"},
                {id: "2", name: "Актогайский район"},
                {id: "3", name: "Бухар-Жырауский район"},
                {id: "4", name: "Каркаралинский район"},
                {id: "5", name: "Нуринский район"},
                {id: "6", name: "Осакаровский район"},
                {id: "7", name: "Улытауский район"},
                {id: "8", name: "Караганда"},
                {id: "9", name: "Темиртау"},
                {id: "10", name: "Балхаш"},
                {id: "11", name: "Жезказган"},
                {id: "12", name: "Сатпаев"},
            ]
        },
        "9": { // Костанайская область
            districts: [
                {id: "1", name: "Алтынсаринский район"},
                {id: "2", name: "Аулиекольский район"},
                {id: "3", name: "Денисовский район"},
                {id: "4", name: "Житикаринский район"},
                {id: "5", name: "Карабалыкский район"},
                {id: "6", name: "Карасуский район"},
                {id: "7", name: "Костанайский район"},
                {id: "8", name: "Мендыкаринский район"},
                {id: "9", name: "Наурзумский район"},
                {id: "10", name: "Сарыкольский район"},
                {id: "11", name: "Тарановский район"},
                {id: "12", name: "Узункольский район"},
                {id: "13", name: "Костанай "},
                {id: "14", name: "Рудный"},
                {id: "15", name: "Лисаковск"},
            ]
        },
        "10": { // Кызылординская область
            districts: [
                {id: "1", name: "Аральский район"},
                {id: "2", name: "Жалагашский район"},
                {id: "3", name: "Казалинский район"},
                {id: "4", name: "Кармакшинский район"},
                {id: "5", name: "Сырдарьинский район"},
                {id: "6", name: "Шиелийский район"},
                {id: "7", name: "Жанакорганский район"},
                {id: "8", name: "Кызылорда"},
            ]
        },
        "11": { // Мангистауская область
            districts: [
                {id: "1", name: "Бейнеуский район"},
                {id: "2", name: "Каракиянский район"},
                {id: "3", name: "Мангыстауский район"},
                {id: "4", name: "Мунайлынский район"},
                {id: "5", name: "Тупкараганский район"},
                {id: "6", name: "Актау"},
                {id: "7", name: "Жанаозен"},
            ]
        },
        "12": { // Павлодарская область
            districts: [
                {id: "1", name: "Алтынсаринский район"},
                {id: "2", name: "Баянаульский район"},
                {id: "3", name: "Железинский район"},
                {id: "4", name: "Иртышский район"},
                {id: "5", name: "Качирский район"},
                {id: "6", name: "Павлодарский район"},
                {id: "7", name: "Успенский район"},
                {id: "8", name: "Павлодар"},
                {id: "9", name: "Экибастуз"},
                {id: "10", name: "Аксу"},
            ]
        },
        "13": { // Северо-Казахстанская область
            districts: [
                {id: "1", name: "Акжарский район"},
                {id: "2", name: "Айыртауский район"},
                {id: "3", name: "Аккайынский район"},
                {id: "4", name: "Есильский район"},
                {id: "5", name: "Жамбылский район"},
                {id: "6", name: "Кызылжарский район"},
                {id: "7", name: "Мамлютский район"},
                {id: "8", name: "Тайыншинский район"},
                {id: "9", name: "Тимирязевский район"},
                {id: "10", name: "Уалихановский район"},
                {id: "11", name: "Петропавловск"},
            ]
        },
        "14": { // Туркестанская область
            districts: [
                {id: "1", name: "Байдибекский район"},
                {id: "2", name: "Жетысайский район"},
                {id: "3", name: "Казыгуртский район"},
                {id: "4", name: "Махтааральский район"},
                {id: "5", name: "Отырарский район"},
                {id: "6", name: "Сарыагашский район"},
                {id: "7", name: "Сайрамский район"},
                {id: "8", name: "Тюлькубасский район"},
                {id: "9", name: "Туркестан"},
                {id: "10", name: "Кентау"},
                {id: "11", name: "Арысь"},
            ]
        },
        "15": { // Жетысуская область
            districts: [
                {id: "1", name: "Аксуский район"},
                {id: "2", name: "Алакольский район"},
                {id: "3", name: "Каратальский район"},
                {id: "4", name: "Кегенский район"},
                {id: "5", name: "Коксуйский район"},
                {id: "6", name: "Панфиловский район"},
                {id: "7", name: "Талдыкорган "},
            ]
        },
    };

    $(document).ready(function () {
        $('#cityName').text(data[<?=$cookies->getValue('ChangedCity')?>]['districts'][<?=$cookies->getValue('ChangedDistrict')?>-1]['name']);

        let sidebarOffcanvas = new bootstrap.Offcanvas(document.getElementById('sidebarMenu'));
        $('#canvasClose').on('click', function () {
            sidebarOffcanvas.hide();
        });
        // При изменении выбора области
        $('#city-select').on('change', function () {
            const cityId = $(this).val();
            const districtSelect = $('#district-select');
            districtSelect.empty().append('<option value="0">Все районы</option>');
            $('#district-container').toggleClass('d-none', cityId === "0");
            $('#neighborhood-container').addClass('d-none');

            if (cityId === "0") {
                // Если выбрана опция "Весь Казахстан", подгружаем все районы всех областей
                Object.values(data).forEach(region => {
                    region.districts.forEach(district => {
                        districtSelect.append(new Option(district.name, district.id));
                    });
                });
            } else if (data[cityId]) {
                // В противном случае подгружаем только районы выбранной области
                data[cityId].districts.forEach(district => {
                    districtSelect.append(new Option(district.name, district.id));
                });
            }
        });

        // При изменении выбора района
        $('#district-select').on('change', function () {
            const cityId = $('#city-select').val();
            const districtId = $(this).val();
            const neighborhoodSelect = $('#neighborhood-select');
            neighborhoodSelect.empty().append('<option value="0">Все микрорайоны</option>');
            $('#neighborhood-container').toggleClass('d-none', districtId === "0");

            if (districtId === "0") {
                // Если выбрана опция "Все районы", подгружаем все микрорайоны всех районов выбранной области
                if (data[cityId]) {
                    data[cityId].districts.forEach(district => {
                        district.neighborhoods.forEach(neighborhood => {
                            neighborhoodSelect.append(new Option(neighborhood, neighborhood));
                        });
                    });
                }
            } else if (data[cityId]) {
                // В противном случае подгружаем только микрорайоны выбранного района
                const district = data[cityId].districts.find(d => d.id === districtId);
                if (district) {
                    district.neighborhoods.forEach(neighborhood => {
                        neighborhoodSelect.append(new Option(neighborhood, neighborhood));
                    });
                }
            }
        });
    });
</script>
</body>
</html>

<?php $this->endPage() ?>
