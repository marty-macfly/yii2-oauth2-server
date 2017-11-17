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
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create Oauth Clients', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'client_id',
                'value' => function ($model) {
                    return Html::a($model->client_id, ['admin/clients/view', 'id' => $model->client_id]);
                },
                'format' => 'html',
            ],
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
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return Html::a(sprintf("%s (%d)", ($model->user !== null) ? $model->user->username : '?', $model->user_id), ['/user/admin/update', 'id' => $model->user_id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'access_token',
                'value'    => function ($model) {
                    $label = "<span class='pull-right'><kbd>" . count($model->oauthAccessTokens) . "</kbd></span><span class='pull-left'>Access token</span>";
                    return Html::a($label, ['admin/accesstokens', 'SearchAccesstokensModel[client_id]' => $model->client_id]);
                },
                'format' => 'html',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
