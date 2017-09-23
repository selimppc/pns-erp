<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VwApPayable;

class VwApPayableSearch extends VwApPayable
{

	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [            
            [['supplier_id','org_name','branch_id','am_coa_id','coa_title','contct_person','payable_amount'], 'safe'],
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


    public function search($params)
    {
    	$query = VwApPayable::find();

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
            'supplier_id' => $this->supplier_id,
            'org_name' => $this->org_name,
            'branch_id' => $this->branch_id,
            'am_coa_id' => $this->am_coa_id,
            'coa_title' => $this->coa_title,
            'contct_person' => $this->contct_person,
            'payable_amount' => $this->payable_amount
        ]);

        return $dataProvider;


    }

}