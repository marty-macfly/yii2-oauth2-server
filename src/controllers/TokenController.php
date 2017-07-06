<?php

namespace macfly\oauth2server\controllers;

use Yii;
use yii\filters\VerbFilter;

class TokenController extends \filsh\yii2\oauth2server\controllers\RestController
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::$app->user->enableSession = false;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors	= parent::behaviors();
        $behaviors['verbs'] = [
            'class'   => VerbFilter::className(),
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
