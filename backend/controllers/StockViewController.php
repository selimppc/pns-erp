<?php

namespace backend\controllers;

use Yii;
use backend\models\ImGrnDetail;

use backend\models\ImGrnHead;
use backend\models\ImGrnDetailSearch;

use backend\models\VwStockView;

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

        $models = VwStockView::find()->where(['status' => 'confirmed'])->all();

        return $this->render('index', [
            'models' => $models
        ]);

    }

}