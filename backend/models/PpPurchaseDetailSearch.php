<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PpPurchaseDetail;

/**
 * PpPurchaseDetailSearch represents the model behind the search form about `backend\models\PpPurchaseDetail`.
 */
class PpPurchaseDetailSearch extends PpPurchaseDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pp_purchase_head_id', 'product_id', 'created_by', 'updated_by'], 'integer'],
            [['quantity', 'grn_quantity', 'tax_rate', 'tax_amount', 'uom_quantity', 'unit_quantity', 'purchase_rate', 'row_amount'], 'number'],
            [['uom', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = PpPurchaseDetail::find();

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
            'pp_purchase_head_id' => $this->pp_purchase_head_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'grn_quantity' => $this->grn_quantity,
            'tax_rate' => $this->tax_rate,
            'tax_amount' => $this->tax_amount,
            'uom_quantity' => $this->uom_quantity,
            'unit_quantity' => $this->unit_quantity,
            'purchase_rate' => $this->purchase_rate,
            'row_amount' => $this->row_amount,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'uom', $this->uom])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
