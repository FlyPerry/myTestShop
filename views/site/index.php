<?php

use yii\helpers\Url;
use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>

<!-- Category Section (Woman / Man) -->
<section class="categories py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="category position-relative category-woman bg-danger text-white align-middle text-center p-5 position-relative">
                    <div class="dayuButton position-absolute top-0 start-0 p-3">
                        <a href="/catalog/women" class="btn btn-danger" style="zoom: 200%">
                            <?= Yii::t('app', 'dayu') ?>
                        </a>
                    </div>
                    <div class="beruButton position-absolute bottom-0 end-0 p-3">
                        <a href="/catalog/man" class="btn btn-danger" style="zoom: 200%">
                            <?= Yii::t('app', 'beru') ?>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <!-- Аламын-->
        <!--Беремiн-->
    </div>
</section>

<!-- Work Section -->
<section class="work py-5">
    <div class="container text-center">
        <?= Html::a(Yii::t('app', 'work'), Url::to('catalog/work'), ['class' => 'btn btn-warning']);; ?>
    </div>
</section>


<!-- Promo Section with Slider -->
<section class="promo py-5">
    <div class="container">
        <div id="promoCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#promoCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#promoCarousel" data-slide-to="1"></li>
                <li data-target="#promoCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Carousel Inner -->
            <div class="bg-dark carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://placeholder.pics/svg/500x500" class="img-fluid" alt="Promo 1">
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-center">
                            <h2>Экономия до 100 000тг</h2>
                            <p>На выбранны.</p>
                            <a href="#" class="btn btn-primary w-50">Shop</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://placeholder.pics/svg/500x500" class="img-fluid" alt="Promo 2">
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-center">
                            <h2>Exclusive Offer</h2>
                            <p>Get 20% off on select smartphones.</p>
                            <a href="#" class="btn btn-primary w-50">Shop</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://placeholder.pics/svg/500x500" class="img-fluid" alt="Promo 3">
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-center">
                            <h2>New Arrivals</h2>
                            <p>Check out the latest gadgets in stock.</p>
                            <a href="#" class="btn btn-primary w-50">Shop</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="carousel-control-prev" href="#promoCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#promoCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>

