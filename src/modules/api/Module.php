<?php

namespace macfly\oauth2server\modules\api;

use Yii;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();

        if (Yii::$app->has('user')) {
            Yii::$app->user->enableSession = false;
        }

        // Default reply format is json for api
        Yii::$app->response->format = Response::FORMAT_JSON;
    }
}
