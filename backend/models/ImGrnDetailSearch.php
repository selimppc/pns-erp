<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ImGrnDetail;

/**
 * ImGrnDetailSearch represents the model behind the search form about `backend\models\ImGrnDetail`.
 */
class ImGrnDetailSearch extends ImGrnDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'im_grn_head_id', 'product_id', 'created_by', 'updated_by'], 'integer'],
            [['batch_number', 'expire_date', 'uom', 'created_at', 'updated_at'], 'safe'],
            [['receive_quantity', 'cost_price', 'quantity', 'row_amount'], 'number'],
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
        $query = ImGrnDetail::find();

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
            'im_grn_head_id' => $this->im_grn_head_id,
            'product_id' => $this->product_id,
            'expire_date' => $this->expire_date,
            'receive_quantity' => $this->receive_quantity,
            'cost_price' => $this->cost_price,
            'quantity' => $this->quantity,
            'row_amount' => $this->row_amount,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'batch_number', $this->batch_number])
            ->andFilterWhere(['like', 'uom', $this->uom]);

        return $dataProvider;
    }
}
