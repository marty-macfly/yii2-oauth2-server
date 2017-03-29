<?php

namespace macfly\oauth2server\models;

use Yii;
use yii\behaviors\BlameableBehavior;

class OauthAccessTokens extends \filsh\yii2\oauth2server\models\OauthAccessTokens
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'BlameableBehavior'	=> [
				'class' => BlameableBehavior::className(),
				'createdByAttribute' => 'user_id',
				'updatedByAttribute' => false,
				'value'	=> function ($event)
					{
						$behavior						= $this->getBehavior('BlameableBehavior');
						$createdByAttribute	= $behavior->createdByAttribute;

						if($event->name == 'beforeInsert' && !isset($this->$createdByAttribute))
						{
							return $this->$createdByAttribute;
						}

						return $behavior->value;
					},
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
