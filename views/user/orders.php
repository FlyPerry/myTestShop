<?php
/**
 * @var $user \app\models\User
 * @var $userInfo \app\models\UserInfo
 * @var $active integer
 * @var $catalogList \app\models\Catalog
 * @var $product \app\models\Catalog
 */

use yii\helpers\Url;
use \yii\helpers\Html;
?>
<div class="tab-pane fade show active" id="catalog-tab">
    <div class="row">
        <div class="col">
            <h2>Мой каталог</h2>
        </div>
        <div class="col text-end">
            <?= Html::a('Создать',Url::to('order/create'),['class'=>'btn btn-success'])?>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Наименование</th>
            <th>Описание</th>
            <th>Фото</th>
            <th>Дата создания</th>
            <th>Подтверждено</th>
            <th style="width: 1%">Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($catalogList as $product): ?>
            <tr>
                <td><?= $product->name; ?></td>
                <td><?= $product->description; ?></td>
                <td><img src="https://placehold.co/100x100" alt="Detailed description of item 1's photo"
                         class="img-thumbnail"></td>
                <td><?= Yii::$app->formatter->asDatetime($product->date_create, 'dd.MM.Y H:i:s') ?></td>
                <td><?= $product->getStatusVerify() ?></td>
                <td>
                    <div class="btn-group-vertical text-nowrap" role="group" aria-label="Product Actions">
                        <a href="/user/order/view/<?= $product->id; ?>" class="btn btn-primary btn-sm mb-2">
                            <i class="fas fa-eye"></i> Подробнее
                        </a>
                        <a href="/user/order/update/<?= $product->id; ?>" class="btn btn-info btn-sm mb-2">
                            <i class="fas fa-edit"></i> Редактировать
                        </a>
                        <a href="#"
                           class="btn btn-<?= !$product->deleted ? 'danger' : 'success' ?> btn-sm mb-2 toggle-status-btn"
                           data-id="<?= $product->id; ?>"
                           data-status="<?= $product->deleted; ?>">
                            <i class="fas fa-<?= !$product->deleted ? 'toggle-off' : 'toggle-on' ?>"></i>
                            <span class="status-text"><?= !$product->deleted ? 'Отключить' : 'Включить' ?></span>
                        </a>
                        <?=Html::a('<i class="fas fa-check"></i> Просмотреть на сайте',$product->getFinishUrl(),['class'=>'btn btn-success btn-sm','target'=>'_blank'])?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
