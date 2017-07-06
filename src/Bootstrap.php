<?php

namespace macfly\oauth2server;

class Bootstrap extends \filsh\yii2\oauth2server\Bootstrap
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($app->hasModule('oauth2') && ($module = $app->getModule('oauth2')) instanceof Module) {
            parent::bootstrap($module);
        }
    }
}
