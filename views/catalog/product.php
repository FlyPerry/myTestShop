<?php
/**
 * @var Catalog $productInfo
 *
 */

use app\models\Catalog;
use yii\helpers\Html;

?>
<div class="container product-main mb-5 mb-sm-4 mt-5 mt-sm-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><?= Html::a(Yii::t('app', 'main-page'), '/') ?></li>
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
                    <?php $i = 0;
                    foreach ($productInfo->getPhotos() as $photo): ?>
                        <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
                            <img src="<?= Yii::getAlias('@web') . '/' . $photo->photo ?>" class="d-block w-100"
                                 alt="Black wireless headphones on a white background" data-bs-toggle="modal"
                                 data-bs-target="#productModal">
                        </div>
                        <?php $i++; endforeach;
                    unset($i); ?>
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
            <button class="btn btn-primary w-100" data-bs-target="#sellerInfoModal" data-bs-toggle="modal">
                <?= Yii::t('app', 'call-seller') ?>
            </button>
        </div>
    </div>

    <!-- Modal for Fullscreen Image -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(0, 0, 0, 0.8);">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel"
                        style="color: white;"><?= Yii::t('app', 'product-image') ?></h5>
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
                    <h5 class="modal-title" id="sellerInfoModalLabel"><?= Yii::t('app', 'info-seller') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h4><?= $productInfo->getUser()->one()->getUserInfo()->one()->getFio() ?></h4>
                            <p><?= $productInfo->getUser()->one()->getUserInfo()->one()->bio; ?></p>
                            <p><strong><?= Yii::t('app', 'email') ?>
                                    : </strong><?= $productInfo->getUser()->one()->email ?></p>
                            <p><strong><?= Yii::t('app', 'phone-call') ?>: </strong>
                                <a href="tel:<?= $productInfo->getUser()->one()->getUserInfo()->one()->contactPhone; ?>">
                                    <?= $productInfo->getUser()->one()->getUserInfo()->one()->contactPhone; ?></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal"><?= Yii::t('app', 'close') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('#productCarousel .carousel-item img').forEach(img => {
        img.addEventListener('click', function () {
            document.getElementById('modalImage').src = this.src;
        });
    });
</script>
