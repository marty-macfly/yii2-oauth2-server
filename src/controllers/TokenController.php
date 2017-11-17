<?php

namespace macfly\oauth2server\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Response;

class TokenController extends \filsh\yii2\oauth2server\controllers\RestController
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (Yii::$app->has('user')) {
            Yii::$app->user->enableSession = false;
        }

        // Default reply format is json for api
        Yii::$app->response->format = Response::FORMAT_JSON;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['post'],
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        return parent::actionToken();
    }
}
