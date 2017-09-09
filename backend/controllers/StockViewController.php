<?php

namespace backend\controllers;

use Yii;
use backend\models\ImGrnDetail;
use backend\models\ImGrnHead;
use backend\models\ImGrnDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class StockViewController extends Controller{


	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(){

        // confirm grn list
        $confirm_grn_r = ImGrnHead::find()->where(['status' => 'confirmed'])->all();

        $confirm_grn_array = array();

        if(!empty($confirm_grn_r)){
            foreach($confirm_grn_r as $confirm_grn){
                array_push($confirm_grn_array,$confirm_grn->id);
            }
        }

    	$searchModel = new ImGrnDetailSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$confirm_grn_array,'confirmed');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

}