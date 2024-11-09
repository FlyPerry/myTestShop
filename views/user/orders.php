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
    <div class="row mb-3">
        <div class="col">
            <h2><?=Yii::t('app','myCatalog');?></h2>
        </div>
        <div class="col text-end">
            <?= Html::a('Создать', Url::to('order/create'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <!-- Адаптивная таблица с горизонтальным скроллом на мобильных устройствах -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th><?=Yii::t('app','tableNaimenovanie');?></th>
                <th><?=Yii::t('app','tableDiscription');?></th>
                <th><?=Yii::t('app','tablePhoto');?></th>
                <th><?=Yii::t('app','tableDateCreate');?></th>
                <th><?=Yii::t('app','tapleVerify');?></th>
                <th style="width: 1%"><?=Yii::t('app','tableActions');?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($catalogList as $product): ?>
                <tr>
                    <td><?= $product->name; ?></td>
                    <td class="text-truncate" style="max-width: 150px;"><?= $product->description; ?></td>
                    <td>
                        <?php foreach ($product->getPhotos() as $photo): ?>
                            <?= Html::img('/' . Url::to($photo->photo) ?: 'https://placehold.co/100x100',
                                ['alt' => "Фото товара", 'class' => 'img-thumbnail', 'style' => 'width: 80px; height: auto;']); ?>
                        <?php endforeach; ?>
                    </td>
                    <td><?= Yii::$app->formatter->asDatetime($product->date_create, 'dd.MM.Y H:i') ?></td>
                    <td><?= $product->getStatusVerify() ?></td>
                    <td>
                        <!-- Группа кнопок с иконками -->
                        <div class="btn-group" role="group" aria-label="Product Actions">
                            <!--                            <a href="/user/order/view/-->
                            <?php //= $product->id; ?><!--" class="btn btn-primary btn-sm">-->
                            <!--                                <i class="fas fa-eye"></i>-->
                            <!--                            </a>-->
                            <a href="/user/order/update/<?= $product->id; ?>" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <?= Html::a('<i class="fa fa-trash"></i>', ['/user/order/delete/' . $product->id], [
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('app','deleteConfirmMessage'),
                                    'method' => 'post',
                                ],
                            ]) ?>
                            <a href="<?= $product->getFinishUrl() ?>" class="btn btn-success btn-sm" target="_blank">
                                <i class="fa-solid fa-earth-americas"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
