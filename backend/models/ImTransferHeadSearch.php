<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ImTransferHead;

/**
 * ImTransferHeadSearch represents the model behind the search form about `backend\models\ImTransferHead`.
 */
class ImTransferHeadSearch extends ImTransferHead
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'from_branch_id', 'from_currency_id', 'to_branch_id', 'to_currency_id', 'created_by', 'updated_by'], 'integer'],
            [['transfer_number', 'date', 'confirm_date', 'note', 'status', 'created_at', 'updated_at'], 'safe'],
            [['from_exchange_rate', 'to_exchange_rate'], 'number'],
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
        $query = ImTransferHead::find();

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
            'date' => $this->date,
            'confirm_date' => $this->confirm_date,
            'from_branch_id' => $this->from_branch_id,
            'from_currency_id' => $this->from_currency_id,
            'from_exchange_rate' => $this->from_exchange_rate,
            'to_branch_id' => $this->to_branch_id,
            'to_currency_id' => $this->to_currency_id,
            'to_exchange_rate' => $this->to_exchange_rate,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'transfer_number', $this->transfer_number])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
