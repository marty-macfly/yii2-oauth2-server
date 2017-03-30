<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model filsh\yii2\oauth2server\models\OauthAccessTokens */

$this->title = 'Update Oauth Access Tokens: ' . $model->access_token;
$this->params['breadcrumbs'][] = ['label' => 'Oauth Access Tokens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->access_token, 'url' => ['view', 'id' => $model->access_token]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="oauth-access-tokens-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
		'module'  => $module,
	]) ?>

</div>
