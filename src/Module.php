<?php

namespace macfly\oauth2server;

use Yii;

class Module extends \yii\base\Module
{

	public $tokenParamName			= 'accessToken';
	public $tokenAccessLifetime	= 3600 * 24;
	public $userModel						= 'app\models\User';
	public $adminRole						= 'admin';

	public $userAttributes			= [
			'id',
			'username',
			'email',
		];

	public function init()
	{
		parent::init();

		$this->modules = [
			'oauth2'	=> [
				'class'								=> 'filsh\yii2\oauth2server\Module',
				'tokenParamName'			=> $this->tokenParamName,
				'tokenAccessLifetime'	=> $this->tokenAccessLifetime,
				'storageMap'					=> [
					'user_credentials'									=> $this->userModel,
				],
				'grantTypes'					=> [
					'authorization_code'	=> [
						'class'														=> 'OAuth2\GrantType\AuthorizationCode',
					],
					'client_credentials'	=> [
						'class'														=> 'OAuth2\GrantType\ClientCredentials',
					],
					'refresh_token'				=> [
						'class'														=> 'OAuth2\GrantType\RefreshToken',
						'always_issue_new_refresh_token'	=> true
					],
					'user_credentials'		=> [
						'class'														=> 'OAuth2\GrantType\UserCredentials',
					],
				],
			],
		];
	}

  /**
   * Gets Oauth2 Server
   *
   * @return \filsh\yii2\oauth2server\Server
   * @throws \yii\base\InvalidConfigException
   */
  public function getServer()
  {
		$oauth2   = $this->getModule('oauth2');
		return $oauth2->getServer();
	}

	public function getRequest()
	{
		$oauth2   = $this->getModule('oauth2');
		return $oauth2->getRequest();
	}
}
