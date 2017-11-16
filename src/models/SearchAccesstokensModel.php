<?php

namespace macfly\oauth2server\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use macfly\oauth2server\models\OauthAccessTokens;

/**
 * SearchAccesstokensModel represents the model behind the search form about `filsh\yii2\oauth2server\models\OauthAccessTokens`.
 */
class SearchAccesstokensModel extends OauthAccessTokens
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['access_token', 'client_id', 'expires', 'scope'], 'safe'],
            [['user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $array_client_id=null)
    {
        $query = OauthAccessTokens::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'expires' => $this->expires,
        ]);

        $query->andFilterWhere(['like', 'access_token', $this->access_token])
            ->andFilterWhere(['like', 'client_id', $this->client_id])
            ->andFilterWhere(['like', 'scope', $this->scope])
            ->andFilterWhere(['IN', 'client_id', $array_client_id]);
        ;

        return $dataProvider;
    }
}
