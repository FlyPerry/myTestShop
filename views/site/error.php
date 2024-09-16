<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */

/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;
?>
<style>
    /*--------------------------------------------------------------
# Error 404
--------------------------------------------------------------*/
    .error-404 {
        padding: 30px;
    }

    .error-404 h1 {
        font-size: 120px;
        font-weight: 700;
        color: #4154f1;
        margin-bottom: 0;
        line-height: 150px;
    }

    .error-404 h2 {
        font-size: 24px;
        font-weight: 700;
        color: #012970;
        margin-bottom: 30px;
    }

    .error-404 .btn {
        background: #51678f;
        color: #fff;
        padding: 8px 30px;
    }

    .error-404 .btn:hover {
        background: #3e4f6f;
    }

    @media (min-width: 992px) {
        .error-404 img {
            max-width: 50%;
        }
    }

</style>
<section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
    <h1><?= Html::encode($this->title) ?></h1>
    <h2><?= nl2br(Html::encode($message)) ?></h2>
    <a class="btn btn-clipboard" href="/">Вернуться домой</a>
    <img src="/img/not-found.svg" class="img-fluid py-5" alt="Page Not Found">

</section>
