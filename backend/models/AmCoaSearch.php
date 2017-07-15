<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AmCoa;

/**
 * AmCoaSearch represents the model behind the search form about `backend\models\AmCoa`.
 */
class AmCoaSearch extends AmCoa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group_one_id', 'group_two_id', 'group_three_id', 'group_four_id', 'branch_id', 'created_by', 'updated_by'], 'integer'],
            [['account_code', 'title', 'description', 'account_type', 'account_usage', 'analyical_code', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = AmCoa::find();

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
            'group_one_id' => $this->group_one_id,
            'group_two_id' => $this->group_two_id,
            'group_three_id' => $this->group_three_id,
            'group_four_id' => $this->group_four_id,
            'branch_id' => $this->branch_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'account_code', $this->account_code])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'account_type', $this->account_type])
            ->andFilterWhere(['like', 'account_usage', $this->account_usage])
            ->andFilterWhere(['like', 'analyical_code', $this->analyical_code])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
