<?php

namespace macfly\oauth2server\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\web\Controller;

use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;

class AuthorizeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors										= parent::behaviors();
        $behaviors['exceptionFilter'] = [
            'class'			=> ErrorToExceptionFilter::className()
        ];
        $behaviors['verbs']						= [
            'class'		=> VerbFilter::className(),
            'actions'	=> [
                'index' => ['get'],
            ],
        ];

        return $behaviors;
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) { # Send to login page
            return Yii::$app->user->loginRequired();
        }

        $server		= $this->module->getServer();
        $request	= $this->module->getRequest();
        $response	= $server->handleAuthorizeRequest($request, new \OAuth2\Response(), true, Yii::$app->user->getID());

        Yii::$app->response->statusCode = $response->getStatusCode();

        $headers = Yii::$app->response->headers;

        foreach ($response->getHttpHeaders() as $name => $header) {
            $headers->set($name, $header);
        }

        Yii::$app->response->content = $response->getResponseBody();
    }
}
