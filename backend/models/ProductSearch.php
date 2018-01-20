<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * ProductSearch represents the model behind the search form about `backend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'class', 'group', 'category', 'currency_id', 'supplier_id', 'created_by', 'updated_by'], 'integer'],
            [['product_code', 'title', 'description', 'image', 'thumb_image', 'model', 'size', 'origin', 'sell_uom', 'purchase_uom', 'stock_uom', 'pack_size', 'stock_type', 'generic', 'manufacture_code', 'max_level', 'min_level', 're_order', 'created_at', 'updated_at','status','style'], 'safe'],
            [['exchange_rate', 'sell_rate', 'cost_price', 'sell_uom_qty', 'purchase_uom_qty', 'sell_tax', 'stock_uom_qty'], 'number'],
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
        $query = Product::find();

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
        /**
         * Setup your sorting attributes
         * Note: This is setup before the $this->load($params)
         * statement below
         */

        $dataProvider->setSort([
            'attributes' => [
                'id' => [
                    'asc' => ['id' => SORT_ASC],
                    'desc' => ['id' => SORT_DESC],
                    'default' => SORT_DESC
                ],
                /*'name' => [
                    'asc' => ['date' => SORT_ASC],
                    'desc' => ['date' => SORT_DESC],
                    'default' => SORT_ASC,
                ],*/
            ],
            'defaultOrder' => [
                'id' => SORT_DESC
            ]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'class' => $this->class,
            'group' => $this->group,
            'category' => $this->category,
            'currency_id' => $this->currency_id,
            'exchange_rate' => $this->exchange_rate,
            'sell_rate' => $this->sell_rate,
            'cost_price' => $this->cost_price,
            'sell_uom_qty' => $this->sell_uom_qty,
            'purchase_uom_qty' => $this->purchase_uom_qty,
            'sell_tax' => $this->sell_tax,
            'stock_uom_qty' => $this->stock_uom_qty,
            'supplier_id' => $this->supplier_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'product_code', $this->product_code])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'style', $this->style])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'thumb_image', $this->thumb_image])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'origin', $this->origin])
            ->andFilterWhere(['like', 'sell_uom', $this->sell_uom])
            ->andFilterWhere(['like', 'purchase_uom', $this->purchase_uom])
            ->andFilterWhere(['like', 'stock_uom', $this->stock_uom])
            ->andFilterWhere(['like', 'pack_size', $this->pack_size])
            ->andFilterWhere(['like', 'stock_type', $this->stock_type])
            ->andFilterWhere(['like', 'generic', $this->generic])
            ->andFilterWhere(['like', 'manufacturer_code', $this->manufacturer_code])
            ->andFilterWhere(['like', 'max_level', $this->max_level])
            ->andFilterWhere(['like', 'min_level', $this->min_level])
            ->andFilterWhere(['like', 're_order', $this->re_order]);

        return $dataProvider;
    }
}