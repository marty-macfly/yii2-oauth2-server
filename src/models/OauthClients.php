<?php

namespace macfly\oauth2server\models;

use Yii;
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

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		$rules	= parent::rules();

		unset($rules['user_id']);

		return $rules;
	}
}
