<?php

namespace macfly\oauth2server\models;

use Yii;
use macfly\oauth2server\Module;
use macfly\oauth2server\behaviors\BlameableBehavior;

class OauthClients extends \filsh\yii2\oauth2server\models\OauthClients
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            BlameableBehavior::className(),
        ];
    }

    public function getAccessTokens()
    {
        return $this->hasMany(OauthAccessTokens::className(), ['client_id' => 'client_id']);
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
