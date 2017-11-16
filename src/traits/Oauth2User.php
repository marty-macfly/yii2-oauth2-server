<?php

namespace macfly\oauth2server\traits;

use Yii;

use macfly\oauth2server\models\OauthAccessTokens;
use macfly\oauth2server\models\OauthClients;

trait Oauth2User
{
    /**
     * Implemented for Oauth2 Interface
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        /** @var \filsh\yii2\oauth2server\Module $module */
        $module = Yii::$app->getModule('oauth2');
        $module->getRequest()->headers['AUTHORIZATION'] = sprintf("Bearer %s", $token);
        $module->getServer()->getResourceController()->verifyResourceRequest($module->getRequest(), new \OAuth2\Response());
        $token = $module->getServer()->getResourceController()->getToken();
        return !empty($token['user_id'])
            ? static::findIdentity($token['user_id'])
            : null;
    }

    /**
     * Implemented for Oauth2 Interface
     */
    public function checkUserCredentials($username, $password)
    {
        $user = static::findByUsername($username);
        if (empty($user)) {
            return false;
        }
        return $user->validatePassword($password);
    }

    /**
     * Implemented for Oauth2 Interface
     */
    public function getUserDetails($username)
    {
        $user = static::findByUsername($username);
        return ['user_id' => $user->getId()];
    }

    /**
    * Implemented for Oauth2 Interface
    */
    public function getAuthKey()
    {
        $client           = $this->getOauthClient();
        $token            = new OauthAccessTokens();
        $token->loadDefaultValues();
        $token->client_id = $client->client_id;
        $token->user_id   = $client->user_id;

        if ($token->save()) {
            return $token->access_token;
        }

        return null;
    }

    public function getOauthClient()
    {
        if (($client = OauthClients::findOne(['user_id' => $this->id])) === null) {
            $client                = new OauthClients();
            $client->client_id     = $this->username;
            $client->user_id       = $this->id;
            $client->client_secret = substr(hash('sha512', mt_rand() . mt_rand() . mt_rand() . mt_rand() . microtime(true) . uniqid(mt_rand(), true)), 0, 32);
            $client->redirect_uri  = '.';
            $client->grant_types   = 'client_credentials';
            $client->save();
        }

        return $client;
    }
}
