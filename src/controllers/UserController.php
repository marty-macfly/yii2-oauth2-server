<?php

namespace macfly\oauth2server\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\Controller;

use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;

class UserController extends Controller
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
        $behaviors										= parent::behaviors();
        $behaviors['authenticator']		= [
            'class' 			=> CompositeAuth::className(),
            'authMethods' => [
                ['class' => HttpBearerAuth::className()],
                ['class' => QueryParamAuth::className(), 'tokenParam' => 'accessToken'],
            ],
        ];
        $behaviors['verbs']           = [
            'class'   => VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
            ],
        ];
        $behaviors['exceptionFilter']	= [
            'class' => ErrorToExceptionFilter::className()
        ];
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actionIndex()
    {
        $identity	= Yii::$app->user->getIdentity();
        $user			= [];

        foreach($this->module->userAttributes as $name)
        {
            if(($value = ArrayHelper::getValue($identity, $name)) !== null)
            {
                $user[$name] = $value;
            }
        };

        return $user;
    }
}
