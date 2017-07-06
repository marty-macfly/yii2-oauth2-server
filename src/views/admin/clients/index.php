<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel macfly\oauth2server\models\SearchClientsModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oauth-clients-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Oauth Clients', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'client_id',
            'redirect_uri',
            'grant_types',
            'scope',
            'user_id',
            'access_token'	=> [
                'label'	=>'Access Token',
                'content'	=> function($model){
                    $label = "<span class='pull-right'><kbd>" . count($model->oauthAccessTokens) . "</kbd></span><span class='pull-left'>Access token</span>";
                    return Html::a($label, ['admin/accesstokens', 'SearchAccesstokensModel[client_id]' => $model->client_id]);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
