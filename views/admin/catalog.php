<?php

use app\models\Catalog;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $itemsForModerate Catalog;
 * @var $product Catalog;
 *


 */
?>


<div class="tab-pane fade show active" id="catalog-tab">
    <div class="row mb-3">
        <div class="col">
            <h2>Поступившие на модерацию объявления</h2>
        </div>
    </div>

    <!-- Адаптивная таблица с горизонтальным скроллом на мобильных устройствах -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Наименование</th>
                <th>Описание</th>
                <th>Категория</th>
                <th>Фото</th>
                <th>Дата создания</th>
                <th>Подтверждено</th>
                <th style="width: 1%">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($itemsForModerate as $product): ?>
                <tr>
                    <td><?= $product->name; ?></td>
                    <td class="text-truncate toggle-text">
                        <span><?= $product->description; ?></span>
                    </td>
                    <td><?= $product->categoryName; ?></td>

                    <td>
                        <?php foreach ($product->getPhotos() as $photo): ?>
                            <?= Html::img('/' . Url::to($photo->photo) ?? 'https://placehold.co/100x100',
                                ['alt' => "Фото товара", 'class' => 'img-thumbnail', 'style' => 'width: 80px; height: auto;']); ?>
                        <?php endforeach; ?>
                    </td>
                    <td><?= Yii::$app->formatter->asDatetime($product->date_create, 'dd.MM.Y H:i:s') ?></td>
                    <td><?= $product->getStatusVerify() ?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Product Actions">
                            <!-- Первая кнопка: для изменения статуса -->
                            <a href="<?= Url::to(['admin/moderate-accept', 'id' => $product->id]) ?>"
                               class="btn btn-success btn-sm">
                                <i class="fas fa-check"></i> Подтвердить
                            </a>

                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Обработчик клика по ячейке
        $('.toggle-text').on('click', function() {
            var $span = $(this).find('span');

            // Проверяем текущее состояние и меняем
            if ($span.css('white-space') === 'nowrap') {
                $span.css('white-space', 'wrap');  // Переход на wrap
            } else {
                $span.css('white-space', 'nowrap');  // Переход на nowrap
            }
        });
    });
</script>