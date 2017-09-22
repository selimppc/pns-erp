<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CodesParam;

/**
 * CodesParamSearch represents the model behind the search form about `backend\models\CodesParam`.
 */
class CodesParamSearch extends CodesParam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'am_coa_id', 'am_coa_cr_id', 'am_coa_dr_id', 'am_coa_tax_id', 'created_by', 'updated_by'], 'integer'],
            [['type', 'code', 'title', 'long', 'percentage', 'status', 'created_at', 'updated_at','am_coa_discount_id'], 'safe'],
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
        $query = CodesParam::find();

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
            'am_coa_id' => $this->am_coa_id,
            'am_coa_cr_id' => $this->am_coa_cr_id,
            'am_coa_dr_id' => $this->am_coa_dr_id,
            'am_coa_tax_id' => $this->am_coa_tax_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'long', $this->long])
            ->andFilterWhere(['like', 'am_coa_discount_id', $this->am_coa_discount_id])
            ->andFilterWhere(['like', 'percentage', $this->percentage])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
