<?php

namespace macfly\oauth2server\models;

use Yii;
use macfly\oauth2server\Module;
use macfly\oauth2server\behaviors\BlameableBehavior;

class OauthAccessTokens extends \filsh\yii2\oauth2server\models\OauthAccessTokens
{
    public function loadDefaultValues($skipIfSet = true)
    {
        parent::loadDefaultValues($skipIfSet);

        $this->expires = Yii::$app->formatter->asDatetime(time() + Module::getInstance()->tokenAccessLifetime, 'yyyy-MM-dd HH:mm:ss');

        if (!$skipIfSet || $this->access_token === null) {
            $this->access_token = substr(hash('sha512', mt_rand() . mt_rand() . mt_rand() . mt_rand() . microtime(true) . uniqid(mt_rand(), true)), 0, 40);
        }

        return $this;
    }

    public function beforeValidate()
    {
        $isValid = parent::beforeValidate();

        // If user_id not set but we've got a client_id get user_id of client_id
        if (!isset($this->user_id) && isset($this->client_id)) {
            $this->user_id = $this->client->user_id;
        }

        return $isValid;
    }

    public function getClient()
    {
        return $this->hasOne(OauthClients::className(), ['client_id' => 'client_id']);
    }

    public function getUser()
    {
        $module = Module::getInstance();
        if ($module !== null && ($user = $module->get('user', false)) !== null && $user->identityClass !== null) {
            return $this->hasOne($user->identityClass, ['id' => 'user_id']);
        }
        return null;
    }
}
