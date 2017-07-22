<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ItImGl;

/**
 * ItImGlSearch represents the model behind the search form about `backend\models\ItImGl`.
 */
class ItImGlSearch extends ItImGl
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'branch_id', 'dr_coa_id', 'cr_coa_id'], 'integer'],
            [['transaction_code', 'group'], 'safe'],
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
        $query = ItImGl::find();

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
            'dr_coa_id' => $this->dr_coa_id,
            'cr_coa_id' => $this->cr_coa_id,
        ]);

        $query->andFilterWhere(['like', 'transaction_code', $this->transaction_code])
            ->andFilterWhere(['like', 'group', $this->group]);

        return $dataProvider;
    }
}
