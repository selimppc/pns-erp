<?php

namespace backend\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class SalesSettingsController extends Controller{

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
     * Lists all AmCoa models.
     * @return mixed
     */
    public function actionIndex()
    {
    	return $this->render('index');
    }
    
}