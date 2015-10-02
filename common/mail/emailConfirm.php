<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/email-confirm'])
?>

Hello, <?= Html::encode($user->user_name) ?>!

To confirm the address click here:

<?= Html::a(Html::encode($confirmLink), $confirmLink) ?>

If you are not registered on our website, just delete this email.