<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model filsh\yii2\oauth2server\models\OauthClients */

$this->title = $model->client_id;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oauth-clients-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->client_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->client_id], [
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
            [
                'attribute' => 'client_id',
                'value' => function ($model) {
                    return Html::a($model->client_id, ['clients/view', 'id' => $model->client_id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return sprintf("%s (%d)", ($model->user !== null) ? $model->user->username : '?', $model->user_id);
                },
            ],
            'client_secret',
            [
                'attribute' => 'redirect_uri',
                'value' => function ($model) {
                    if ($model->redirect_uri === null) {
                        return '';
                    }

                    $value = '';
                    foreach (explode(" ", $model->redirect_uri) as $uri) {
                        $value .= Html::a($model->redirect_uri, $model->redirect_uri);
                    }
                    return $value;
                },
                'format' => 'html',
            ],
            'grant_types',
            'scope',
        ],
    ]) ?>

</div>
