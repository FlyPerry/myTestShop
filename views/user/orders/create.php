<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Catalog;
use yii\helpers\ArrayHelper;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Catalog */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories \app\models\Category */

$this->title = 'Создание нового товара в каталоге';
?>
<div class="tab-pane fade show active" id="dashboard-tab">

    <div class="catalog-create">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="catalog-form">

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <!-- Скрытое поле user_id -->
            <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

            <!-- Радиобаттоны для фильтрации категорий -->
            <div class="form-group">
                <label>Тип категории</label><br>
                <?= Html::radio('category_type', false, ['value' => 'man', 'label' => 'Беру', 'class' => 'category-type']) ?>
                <?= Html::radio('category_type', false, ['value' => 'women', 'label' => 'Даю', 'class' => 'category-type']) ?>
                <?= Html::radio('category_type', false, ['value' => 'work', 'label' => 'Работа', 'class' => 'category-type']) ?>
            </div>
            <!-- Поле для выбора категории -->
            <?= $form->field($model, 'category')->dropDownList(
                ArrayHelper::map($categories, 'id', 'name'), // Изначально все категории
                ['prompt' => 'Выберите категорию', 'id' => 'category-dropdown', 'disabled' => true] // ID для JS
            )->label('Категория') ?>

            <!-- Поле для ввода имени -->
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <!-- Поле для описания -->
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <!-- Поле для загрузки нескольких изображений -->
            <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*', 'id' => 'image-input'])->label('Фотографии товара') ?>

            <div id="image-preview" style="display: flex; flex-wrap: wrap; margin-top: 10px;"></div>

            <!-- Поле для ввода ссылки на YouTube -->
            <?= $form->field($model, 'youtubeLink')->textInput(['maxlength' => true])->label('YouTube Ссылка') ?>

            <div class="form-group">
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <?php
    // Передаем данные всех категорий для фильтрации через JavaScript
    $categoriesJson = json_encode(ArrayHelper::toArray($categories, [
        'app\models\Category' => [
            'id',
            'name',
            'type', // Здесь предполагается, что в таблице Category есть поле type, которое может принимать значения 'men', 'women' или 'services'
        ]
    ]));

    $this->registerJs(<<<JS
    // Все категории в формате JSON
    var allCategories = $categoriesJson;

    // Функция для обновления выпадающего списка категорий
    function updateCategoryDropdown(type) {
        var categories = allCategories.filter(function(category) {
            return category.type === type; // Фильтрация по типу
        });
        
        categoryDropdown = $('#category-dropdown');
        categoryDropdown.empty(); // Очищаем старые значения

        categoryDropdown.append('<option value="">Выберите категорию</option>'); // Пустой вариант

        // Добавляем отфильтрованные категории в выпадающий список
        categories.forEach(function(category) {
            categoryDropdown.append('<option value="' + category.id + '">' + category.name + '</option>');
        });
    }

    // Обработка клика по радиобаттону
    $('.category-type').on('change', function() {
        var selectedType = $(this).val();
        updateCategoryDropdown(selectedType); // Обновляем список категорий
        categoryDropdown.removeAttr('disabled'); 
    });

    // Инициализация с фильтрацией мужских категорий по умолчанию
    // updateCategoryDropdown('men');
JS
        , View::POS_READY);
    ?>
    <script>
        document.getElementById('image-input').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = ''; // Clear previous previews

            const files = event.target.files; // Get the selected files

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // Check if the file is an image
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Create an img element
                        const img = document.createElement('img');
                        img.src = e.target.result; // Set the source to the file data
                        img.style.width = '100px'; // Set the width for the preview
                        img.style.height = 'auto'; // Maintain aspect ratio
                        img.style.marginRight = '10px'; // Space between images

                        // Append the img to the preview container
                        previewContainer.appendChild(img);
                    }

                    reader.readAsDataURL(file); // Read the file as a data URL
                }
            }
        });
    </script>

    <style>
        #image-preview img {
            border: 1px solid #ddd; /* Add a border around the images */
            border-radius: 4px; /* Rounded corners */
            padding: 5px; /* Space around the images */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1); /* Add shadow */
        }
    </style>