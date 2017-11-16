<?php

namespace macfly\oauth2server;

class Bootstrap extends \filsh\yii2\oauth2server\Bootstrap
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if (($module = Module::getMe($app)) !== null) {
            parent::bootstrap($module);
        }
    }
}
