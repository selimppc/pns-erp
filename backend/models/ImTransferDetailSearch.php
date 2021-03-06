<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ImTransferDetail;

/**
 * ImTransferDetailSearch represents the model behind the search form about `backend\models\ImTransferDetail`.
 */
class ImTransferDetailSearch extends ImTransferDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'im_transfer_head_id', 'product_id', 'created_by', 'updated_by'], 'integer'],
            [['uom', 'created_at', 'updated_at'], 'safe'],
            [['quantity', 'rate'], 'number'],
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
        $query = ImTransferDetail::find();

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
            'im_transfer_head_id' => $this->im_transfer_head_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'rate' => $this->rate,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'uom', $this->uom]);

        return $dataProvider;
    }
}
