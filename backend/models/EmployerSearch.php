<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Employer;

/**
 * EmployerSearch represents the model behind the search form about `backend\models\Employer`.
 */
class EmployerSearch extends Employer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'branch_id', 'created_by', 'updated_by'], 'integer'],
            [['employer_code', 'name', 'api_id', 'address', 'terotorry', 'type', 'cell', 'phone', 'fax', 'email', 'market', 'hub', 'status', 'created_at', 'updated_at'], 'safe'],
            [['credit_limit'], 'number'],
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
    public function search($params)
    {
        $query = Employer::find();

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
            'branch_id' => $this->branch_id,
            'credit_limit' => $this->credit_limit,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'employer_code', $this->employer_code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'api_id', $this->api_id])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'terotorry', $this->terotorry])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'cell', $this->cell])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'market', $this->market])
            ->andFilterWhere(['like', 'hub', $this->hub])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
