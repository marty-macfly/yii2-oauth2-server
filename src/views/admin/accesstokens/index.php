<?php

use Yii;
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel macfly\oauth2server\models\SearchAccesstokensModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Oauth Access Tokens";

if(!is_null($searchModel->client_id))
{
    $this->title .= sprintf(" of: %s", $searchModel->client_id);
    $this->params['breadcrumbs'][] = ['label' => 'Oauth Clients', 'url' => ['admin/clients/index']];
    $this->params['breadcrumbs'][] = ['label' => $searchModel->client_id, 'url' => ['admin/clients/view', 'id' => $searchModel->client_id]];
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oauth-access-tokens-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Access Token', ['create', 'client_id' => $searchModel->client_id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'access_token',
            'client_id',
            'user_id',
            'expires:datetime',
            'scope',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}{update}{delete}']
        ],
    ]); ?>
</div>
