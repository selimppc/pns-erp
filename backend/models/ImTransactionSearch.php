<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ImTransaction;

/**
 * ImTransactionSearch represents the model behind the search form about `backend\models\ImTransaction`.
 */
class ImTransactionSearch extends ImTransaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'branch_id', 'created_by', 'updated_by'], 'integer'],
            [['transaction_number', 'batch_number', 'date', 'expire_date', 'uom', 'sign', 'reference_number', 'reference_row', 'note', 'status', 'created_at', 'updated_at'], 'safe'],
            [['quantity', 'foreign_rate', 'rate', 'total_price', 'base_value'], 'number'],
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
        $query = ImTransaction::find();

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
            'product_id' => $this->product_id,
            'branch_id' => $this->branch_id,
            'date' => $this->date,
            'expire_date' => $this->expire_date,
            'quantity' => $this->quantity,
            'foreign_rate' => $this->foreign_rate,
            'rate' => $this->rate,
            'total_price' => $this->total_price,
            'base_value' => $this->base_value,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'transaction_number', $this->transaction_number])
            ->andFilterWhere(['like', 'batch_number', $this->batch_number])
            ->andFilterWhere(['like', 'uom', $this->uom])
            ->andFilterWhere(['like', 'sign', $this->sign])
            ->andFilterWhere(['like', 'reference_number', $this->reference_number])
            ->andFilterWhere(['like', 'reference_row', $this->reference_row])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
