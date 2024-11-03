<?php
/**
 * @var Catalog $productInfo
 *
 */

use app\models\Catalog;
use yii\helpers\Html;

?>
<div class="container product-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><?= Html::a('Главная', '/') ?></li>
            <li class="breadcrumb-item"><?= Html::a($productInfo->getCategory()->one()->getTranslatedType(), $productInfo->getUrlCategoryTypeBreadcrumb()); ?></li>
            <li class="breadcrumb-item"><?= Html::a($productInfo->categoryName, $productInfo->getUrlCategoryBreadcrumb()); ?></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $productInfo->name; ?></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-6">
            <!-- Carousel -->
            <div id="productCarousel" class="carousel slide">
                <div class="carousel-inner">
                    <?php $i = 0; foreach ($productInfo->getPhotos() as $photo): ?>
                    <div class="carousel-item <?=$i == 0 ? 'active' : '' ?>">
                        <img src="<?= Yii::getAlias('@web') . '/' . $photo->photo ?>" class="d-block w-100"
                             alt="Black wireless headphones on a white background" data-bs-toggle="modal"
                             data-bs-target="#productModal">
                    </div>
                    <?php $i++; endforeach; unset($i); ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-md-6 product-details">
            <h1><?= $productInfo->name; ?></h1>
            <p><?= $productInfo->description; ?></p>
            <button class="btn btn-primary w-100" data-bs-target="#sellerInfoModal" data-bs-toggle="modal">Связаться с
                продавцом
            </button>
        </div>
    </div>

    <!-- Modal for Fullscreen Image -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(0, 0, 0, 0.8);">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel" style="color: white;">Product Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" id="modalImage" class="img-fluid" alt="Product Image">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sellerInfoModal" tabindex="-1" aria-labelledby="sellerInfoModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sellerInfoModalLabel">Информация о продавце</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h4><?= $productInfo->getUser()->one()->getUserInfo()->one()->getFio() ?></h4>
                            <p><?= $productInfo->getUser()->one()->getUserInfo()->one()->bio; ?></p>
                            <p><strong>email: </strong><?= $productInfo->getUser()->one()->email ?></p>
                            <p><strong>Телефон для
                                    связи: </strong><?= $productInfo->getUser()->one()->getUserInfo()->one()->contactPhone; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <section class="similar-products mt-5">
        <h2 class="mb-3">Вам также может понравиться</h2>
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://placehold.co/300x300" class="card-img-top" alt="Black gaming headset">
                                <div class="card-body">
                                    <h5 class="card-title">Surround Sound 10.2 Gaming Headset</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://placehold.co/300x300" class="card-img-top"
                                     alt="MX50 wired earbud headphones">
                                <div class="card-body">
                                    <h5 class="card-title">MX50 Wired Earbud Headphones</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://placehold.co/300x300" class="card-img-top"
                                     alt="Black in-ear noise cancelling earbuds">
                                <div class="card-body">
                                    <h5 class="card-title">In-ear Noise Cancelling & Isolating Wireless Earbuds</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://placehold.co/300x300" class="card-img-top"
                                     alt="Certified Pantronix buds wireless earbuds">
                                <div class="card-body">
                                    <h5 class="card-title">Certified Pantronix Buds Wireless Earbud Headphones</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <img src="https://placehold.co/300x300" class="card-img-top"
                                     alt="Drums pro wireless on-ear headphones">
                                <div class="card-body">
                                    <h5 class="card-title">Drums Pro Wireless On-Ear Headphones</h5>
                                </div>
                            </div>
                        </div>
                        <!-- Repeat for each similar product -->
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </section>
</div>
<script>
    document.querySelectorAll('#productCarousel .carousel-item img').forEach(img => {
        img.addEventListener('click', function () {
            document.getElementById('modalImage').src = this.src;
        });
    });
</script>
