<?php

namespace backend\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class SalesReportsController extends Controller{

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


     /**
     * @return mixed
     */
    public function actionIndex()
    {
    	return $this->render('index');
    }

    /**
     * @return mixed
     */
    public function actionMonthWiseReport()
    {
        return $this->render('month-wise-report');
    }


        /**
     * @return mixed
     */
    public function actionMonthWiseCollectionReport()
    {
        return $this->render('month-wise-collection-report');
    }    
    

}