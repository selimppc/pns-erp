<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SmDetail;

/**
 * SmDetailSearch represents the model behind the search form about `backend\models\SmDetail`.
 */
class SmDetailSearch extends SmDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sm_head_id', 'product_id', 'created_by', 'updated_by'], 'integer'],
            [['uom', 'created_at', 'updated_at'], 'safe'],
            [['uom_quantity', 'rate', 'bonus_quantity', 'quantity', 'row_amount'], 'number'],
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
        $query = SmDetail::find();

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
            'sm_head_id' => $this->sm_head_id,
            'product_id' => $this->product_id,
            'uom_quantity' => $this->uom_quantity,
            'rate' => $this->rate,
            'bonus_quantity' => $this->bonus_quantity,
            'quantity' => $this->quantity,
            'row_amount' => $this->row_amount,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'uom', $this->uom]);

        return $dataProvider;
    }
}
