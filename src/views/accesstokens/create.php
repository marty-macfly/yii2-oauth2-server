<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model filsh\yii2\oauth2server\models\OauthAccessTokens */

$this->title = 'Create Oauth Access Tokens';
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['clients/index']];
$this->params['breadcrumbs'][] = ['label' => $model->client_id, 'url' => ['clients/accesstoken', 'client_id' => $model->client_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oauth-access-tokens-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
