<?php
/**
 * @var Category $categoriesList
 * @var Catalog $catalogList ;
 * @var string $type
 */

use app\models\Catalog;
use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<section class="catalog py-5">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar for categories -->
            <div class="col-md-3">
                <div class="sidebar">
                    <h5>Выберите категорию</h5>
                    <ul class="category-list">
                        <li><a href="/catalog/<?= $type; ?>">Все категории</a></li>
                        <?php foreach ($categoriesList as $category): ?>
                            <li>
                                <?= Html::a($category->name
                                    , Url::to('/catalog/' . $category->type . '/' . $category->id))
                                ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Product grid -->
            <div class="col-md-9">
                <div class="row">
                    <!-- Product item -->
                    <?php foreach ($catalogList as $product): ?>
                        <div class="col-md-3 mb-4">
                            <?php $insideHtml = Html::tag('div',
                                Html::img('https://via.placeholder.com/200', ['alt' => $product->name, 'class' => 'img-fluid']) .
                                Html::tag('p', $product->name), ['class' => 'product-item']); ?>
                            <?= Html::a($insideHtml, '/catalog/product/' . $product->id); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>


