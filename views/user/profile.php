<?php
use yii\widgets\ActiveForm;

/**
 * @var $user \app\models\User
 * @var $userInfo \app\models\UserInfo
 * @var $active integer
 */
?>

<div class="tab-pane fade show active" id="users-tab">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="text-center">
                    <img src="<?= $userInfo->getPhoto(); ?>" alt="Profile picture" class="profile-img w-100">
                    <h2 class="mt-3"><?= $userInfo->getFio(); ?></h2>
                </div>
            </div>
            <div class="col-md-8">
                <h3>Редактировать профиль</h3>
                <?php $form = ActiveForm::begin(['action' => ['user/update', 'id' => $user->id], 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($userInfo, 'firstname')->textInput(['value' => $userInfo->firstname]) ?>
                <?= $form->field($userInfo, 'lastname')->textInput(['value' => $userInfo->lastname]) ?>
                <?= $form->field($user, 'email')->textInput(['value' => $user->email,'disabled'=>true]) ?>
                <?= $form->field($userInfo, 'bio')->textarea(['rows' => 3, 'value' => $userInfo->bio]) ?>
                <?= $form->field($userInfo, 'photo')->fileInput() ?>
                <?= $form->field($userInfo, 'contactPhone')->textInput(['value' => $userInfo->contactPhone]) ?>

                <button type="submit" class="btn btn-primary">Save Changes</button>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
