<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel macfly\oauth2server\models\SearchAccesstokensModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Access Tokens";

if(!is_null($model->client_id))
{
	$this->title .= sprintf("of: %s", $model->client_id);
	$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['clients/index']];
	$this->params['breadcrumbs'][] = ['label' => $model->client_id, 'url' => ['clients/view', 'id' => $model->client_id]];
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oauth-access-tokens-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Access Token', ['create', 'client_id' => $model->client_id], ['class' => 'btn btn-success']) ?>
    </p>
 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'access_token',
            'client_id',
            'user_id',
            'expires',
            'scope',
						['class' => 'yii\grid\ActionColumn', 'template' => '{view}{update}{delete}']
        ],
    ]); ?>
</div>
