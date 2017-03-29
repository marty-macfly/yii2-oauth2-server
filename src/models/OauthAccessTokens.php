<?php

namespace macfly\oauth2server\models;

use Yii;
use yii\behaviors\BlameableBehavior;

class OauthAccessTokens extends filsh\yii2\oauth2server\models\OauthAccessTokens
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			[
				'class' => BlameableBehavior::className(),
				'createdByAttribute' => 'user_id',
				'updatedByAttribute' => false,
			],
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
