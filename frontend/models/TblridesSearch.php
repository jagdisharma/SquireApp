<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Tblrides;

/**
 * TblridesSearch represents the model behind the search form of `frontend\models\Tblrides`.
 */
class TblridesSearch extends Tblrides
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['r_name', 's_location', 'd_location'], 'safe'],
            [['start_latitute', 'start_longitude', 'end_latitude', 'end_longitude'], 'number'],
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
        $query = Tblrides::find();

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
            'start_latitute' => $this->start_latitute,
            'start_longitude' => $this->start_longitude,
            'end_latitude' => $this->end_latitude,
            'end_longitude' => $this->end_longitude,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'r_name', $this->r_name])
            ->andFilterWhere(['like', 's_location', $this->s_location])
            ->andFilterWhere(['like', 'd_location', $this->d_location]);

        return $dataProvider;
    }
}
