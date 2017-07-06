<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model filsh\yii2\oauth2server\models\OauthClients */

$this->title = 'Update Oauth Clients: ' . $model->client_id;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->client_id, 'url' => ['view', 'id' => $model->client_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="oauth-clients-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'		=> $model,
        'module'  => $module,
    ]) ?>

</div>
