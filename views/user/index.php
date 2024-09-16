<?php

use \yii\helpers\Html;

/**
 * @var \app\controllers\UserController $tabs array
 * @var $user \app\models\User
 * @var $userInfo \app\models\UserInfo
 */
foreach ($tabs as $name => $value) {
    $active[$name] = $value == 1 ? 'active' : '';
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 sidebar">
            <h4>Личный кабинет</h4>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a href="#dashboard-tab" class="nav-link <?=$active['dashboard']?>" data-bs-toggle="pill"><i
                                class="fa-solid fa-table-list"></i>
                        Инф. Панель</a>
                </li>
                <li class="nav-item">
                    <a href="#users-tab" class="nav-link <?=$active['profile']?>" data-bs-toggle="pill"><i class="fa-regular fa-id-badge"></i>
                        Мой профиль</a>
                </li>
                <li class="nav-item">
                    <a href="#catalog-tab" class="nav-link <?=$active['orders']?>" data-bs-toggle="pill"><i
                                class="fa-solid fa-bars-staggered"></i>
                        Мои товары</a>
                </li>
                <li class="nav-item">
                    <a href="#messages-tab" class="nav-link <?=$active['sms']?>" data-bs-toggle="pill"><i class="fas fa-envelope"></i>
                        Сообщения</a>
                </li>
                <li class="nav-item">
                    <a href="#help-tab" class="nav-link <?=$active['help']?>" data-bs-toggle="pill"><i class="fas fa-question-circle"></i>
                        Помощь</a>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="fa-solid fa-person-walking-arrow-right"></i> Выйти', '/site/logout', ['class' => 'nav-link', 'data-method' => 'post']) ?>

                </li>
            </ul>
        </div>
        <div class="col-md-9 col-lg-10 content tab-content">
            <?php foreach ($tabs as $name => $active): ?>
                <?= $this->render($name . '.php', ['user' => $user, 'userInfo' => $userInfo, 'active' => $active]); ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
