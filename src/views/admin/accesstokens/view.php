<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model filsh\yii2\oauth2server\models\OauthAccessTokens */

$this->title = $model->access_token;
$this->params['breadcrumbs'][] = ['label' => 'Oauth Access Tokens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oauth-access-tokens-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->access_token], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->access_token], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'access_token',
            [
                'attribute' => 'client_id',
                'value' => function ($model) {
                    return Html::a($model->client_id, ['admin/clients/view', 'id' => $model->client_id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return Html::a(sprintf("%s (%d)", ($model->user !== null) ? $model->user->username : '?', $model->user_id), ['/user/admin/update', 'id' => $model->user_id]);
                },
                'format' => 'html',
            ],
            'expires:datetime',
            'scope',
        ],
    ]) ?>

</div>
