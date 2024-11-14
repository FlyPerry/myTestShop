<?php
/**
 * @var Category $categoriesList
 * @var Catalog $catalogList ;
 * @var Catalog $product ;
 * @var string $type
 */

use app\models\Catalog;
use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;


?>
<style>
    .product-count {
        margin-left: 5px; /* Отступ слева для отделения от имени категории */
        color: #999; /* Цвет текста счетчика */
        display: inline-block; /* Обеспечивает возможность применять отступы снизу */
    }

</style>

<section class="catalog py-5">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php
                $id = Yii::$app->controller->action->id;

                switch ($id) {
                    case 'man':
                        $result = Yii::t('app', 'beru');;
                        break;
                    case 'women':
                        $result = Yii::t('app', 'dayu');;
                        break;
                    case 'work':
                        $result = Yii::t('app', 'work');

                        break;
                    default:
                        $result = ''; // Обработка для других значений
                }
                echo '<h3>' . $result . '</h3>';
                ?>

            </div>
        </div>
        <div class="row">
            <!-- Sidebar for categories -->
            <div class="col-md-3">
                <div class="sidebar">
                    <h5><?= Yii::t('app', 'change-category') ?></h5>
                    <ul class="category-list">
                        <li><a href="/catalog/<?= $type; ?>"><?= Yii::t('app', 'all-categories') ?></a></li>
                        <?php foreach ($categoriesList as $category): ?>
                            <li class="d-flex justify-content-between">
                                <?= Html::a("{$category->getName()}"
                                    , Url::to('/catalog/' . $category->type . '/' . $category->id))
                                ?>
                                <span class="product-count "><?= $category->countProducts; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Product grid -->
            <div class="col-md-9">
                <div class="row">
                    <!-- Product item -->
                    <?php
                    foreach ($catalogList as $product):
                        $mainPhoto = false;
                        foreach ($product->getPhotos() as $photo) {
                            $mainPhoto = '/' . $photo->photo;
                            break;
                        } ?>
                        <div class="col-md-3 mb-4">
                            <?php $insideHtml = Html::tag('div',
                                Html::img($mainPhoto ?: 'https://placehold.co/200', ['alt' => $product->name, 'class' => 'img-fluid']) .
                                Html::tag('p', $product->name), ['class' => 'product-item']); ?>
                            <?= Html::a($insideHtml, '/catalog/product/' . $product->id); ?>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>


