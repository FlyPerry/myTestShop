<?php
use app\components\modal\selectCity\SelectCity;

echo SelectCity::widget();
?>
<style>
    /* Заглушка для фона Hero-секции */
    .hero-section {
        background-image: url('/img/startimage.jpg');
        height: 100vh;
        background-size: cover;
        background-position: center;
    }

    .transparent-bg {
        background-color: rgba(255, 255, 255, 0.8); /* Полупрозрачный белый фон */
        padding: 20px; /* Добавьте отступы, если необходимо */
        border-radius: 8px; /* Закругленные углы */
        width: 50vw;
    }

    /* Общие настройки для мобильных устройств */
    @media (max-width: 768px) {
        /* Hero-секция */
        .hero-section {
            min-height: 70vh; /* Минимальная высота для более компактного отображения */
            padding: 20px; /* Внутренние отступы */
        }

        .transparent-bg {
            width: 90vw; /* На мобильных ширина блока увеличивается */
            padding: 10px; /* Сокращенные отступы для мобильных */
        }

        /* Адаптивные заголовки */
        h1.display-4 {
            font-size: 1.8rem; /* Уменьшаем размер шрифта */
        }

        p {
            font-size: 1rem;
        }

        /* Кнопка выбора города */
        .btn {
            font-size: 0.9rem;
            padding: 10px 15px;
        }

        /* Модальное окно */
        .modal-dialog {
            width: 95%; /* Максимальная ширина на мобильных */
            max-width: 100%; /* Заполнение по ширине экрана */
        }

        /* Настройки для списка выбора */
        .form-select {
            font-size: 0.9rem; /* Уменьшаем шрифт в селектах */
        }

        /* Скрываем лишние элементы для удобства */
        .d-none {
            display: none !important;
        }
    }


</style>
<section class="hero-section text-center d-flex align-items-center">
    <div class="container transparent-bg">
        <h1 class="display-4"><?= Yii::t('app', 'welcome') ?></h1>
        <p><?= Yii::t('app', 'start-text-select-city') ?></p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#locationModal">
            <?= Yii::t('app', 'change-city-text') ?>
        </button>
    </div>


    <?= SelectCity::widget(); ?>

</section>
