<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel macfly\oauth2server\models\SearchAccesstokensModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List access token of: ' . $model->client_id;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->client_id, 'url' => ['view', 'id' => $model->client_id]];
$this->params['breadcrumbs'][] = 'List access token';
?>
<div class="oauth-access-tokens-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Access Token', ['accesstokens/create','client_id'=>$model->client_id], ['class' => 'btn btn-success']) ?>
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

            [
              'class' => 'yii\grid\ActionColumn',
              'header'=> 'Action',
              'template' => '{view}{update}{del}',
              'buttons' => [
                  'del' => function($url,$model){
                    return $model->access_token != null
                    ? Html::a('', ['accesstokens/delete', 'id'=>$model->access_token], [
                        'title' => 'Delete',
                        'class' => 'glyphicon glyphicon-trash',
                        'data' => [
                          'confirm' => "Are you sure you want to delete this item?",
                          'method' => 'post',
                        ],
                      ])
                    : '';
                  },
                  'view' => function($url,$model){
                    return $model->access_token != null
                    ? Html::a('', ['accesstokens/view', 'id'=>$model->access_token], [
                        'title' => 'View',
                        'class' => 'glyphicon glyphicon-eye-open',
                      ])
                    : '';
                  },
                  'update' => function($url,$model){
                    return $model->access_token != null
                    ? Html::a('', ['accesstokens/update', 'id'=>$model->access_token], [
                        'title' => 'Update',
                        'class' => 'glyphicon glyphicon-pencil',
                      ])
                    : '';
                  },
              ],
            ],
        ],
    ]); ?>
</div>
