<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Tbluserrides;

/**
 * TbluserridesSearch represents the model behind the search form of `frontend\models\Tbluserrides`.
 */
class TbluserridesSearch extends Tbluserrides
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'schedule_id', 'drop_location_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params)
    {
        $query = Tbluserrides::find();

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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'schedule_id' => $this->schedule_id,
            'drop_location_id' => $this->drop_location_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
