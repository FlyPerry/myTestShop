<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
                <?= $form->field($model, 'category')->dropDownList(['0' => 'cat1']) ?>
            </div>
            <div class="col-8">

                <?= $form->field($model, 'photos[]')->fileInput(['multiple' => true]) ?>

            </div>
        </div>
        <!-- Поле для загрузки фотографий -->

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
