<?php

namespace backend\controllers;

use Yii;
use backend\models\ImGrnDetail;

use backend\models\ImGrnHead;
use backend\models\ImGrnDetailSearch;

use backend\models\VwImStockView;
use backend\models\VwImStockViewSearch;

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

        $models = VwImStockView::find()->all();

        $searchModel = new VwImStockViewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=30;

        return $this->render('index', [
            'models' => $models,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

}