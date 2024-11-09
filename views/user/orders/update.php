<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Catalog */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Обновить: ' . $model->name;
?>
<div class="tab-pane fade show active" id="dashboard-tab">

    <?= Html::tag('h1', $this->title); ?>

    <div class="catalog-form">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'category')->dropDownList(
                    ArrayHelper::map($categories, 'id', Yii::$app->language === 'kz-KZ'?'namekz':'name'), // Изначально все категории
                    ['prompt' => Yii::t('app','change-category'), 'id' => 'category-dropdown'] // ID для JS
                )->label(Yii::t('app','category')) ?>
            </div>
            <div class="col-8">
                <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*', 'id' => 'image-input'])->label(Yii::t('app','photo')) ?>
            </div>
        </div>
        <!-- Поле для загрузки фотографий -->

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app','save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
