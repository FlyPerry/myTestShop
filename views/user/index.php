<?php

use \yii\helpers\Html;

/**
 * @var \app\controllers\UserController $tabs array
 * @var $user \app\models\User
 * @var $userInfo \app\models\UserInfo
 * @var $catalogList \app\models\Catalog
 */
foreach ($tabs as $name => $value) {
    $active[$name] = $value == 1 ? 'active' : '';
}
?>

<?php foreach ($tabs as $name => $active): ?>
    <?= $this->render($name . '.php', [
        'user' => $user
        , 'userInfo' => $userInfo
        , 'active' => $active
        , 'catalogList' => $catalogList
    ]); ?>
<?php endforeach; ?>
