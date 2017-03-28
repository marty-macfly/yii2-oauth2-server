<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model filsh\yii2\oauth2server\models\OauthAccessTokens */

$this->title = 'Create Access Tokens';

if(!is_null($model->client_id))
{
  $this->title .= sprintf("of: %s", $model->client_id);
  $this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['clients/index']];
  $this->params['breadcrumbs'][] = ['label' => $model->client_id, 'url' => ['clients/view', 'id' => $model->client_id]];
} else
{
	$this->params['breadcrumbs'][] = ['label' => 'Access Tokens', 'url' => ['index']];
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oauth-access-tokens-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
