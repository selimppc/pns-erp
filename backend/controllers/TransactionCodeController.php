<?php

namespace backend\controllers;

use Yii;
use backend\models\TransactionCode;
use backend\models\TransactionCodeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransactionCodeController implements the CRUD actions for TransactionCode model.
 */
class TransactionCodeController extends Controller
{
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
     * Lists all TransactionCode models.
     * @return mixed
     */
    public function actionIndex($type='')
    {

        if(isset(\Yii::$app->params[$type]) && !empty(\Yii::$app->params[$type])){            
            $transaction_code_help_text =\Yii::$app->params[$type];
        }else{
            $transaction_code_help_text = '';
        }

        $model = new TransactionCode();

        $model->type = $type;
        $model->last_number = '0';
        $model->increment = '1';

        $searchModel = new TransactionCodeSearch();
        $searchModel->type = $type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=30;

        if ($model->load(Yii::$app->request->post()) ) {

            $transaction = \Yii::$app->db->beginTransaction();

            try {

                if($model->save()){

                    $transaction->commit();

                    $model = new TransactionCode();
                    $model->last_number = '0';
                    $model->increment = '1';

                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'model' => $model,
                        'transaction_code_help_text' => $transaction_code_help_text
                    ]);

                }
                

            }catch (\Exception $e) {

                \Yii::$app->getSession()->setFlash('success', $e->getMessage());
                $transaction->rollBack();
            }

            

        }else{

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'transaction_code_help_text' => $transaction_code_help_text
            ]);

        }

        
    }

    /**
     * Displays a single TransactionCode model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$type='')
    {

        if(isset(\Yii::$app->params[$type]) && !empty(\Yii::$app->params[$type])){            
            $transaction_code_help_text =\Yii::$app->params[$type];
        }else{
            $transaction_code_help_text = '';
        }


        $model = $this->findModel($id);

        $searchModel = new TransactionCodeSearch();
        $searchModel->type = $type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'transaction_code_help_text' => $transaction_code_help_text
            ]);

        
    }

    /**
     * Creates a new TransactionCode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type='')
    {

        if(isset(\Yii::$app->params[$type]) && !empty(\Yii::$app->params[$type])){            
            $transaction_code_help_text =\Yii::$app->params[$type];
        }else{
            $transaction_code_help_text = '';
        }

        $model = new TransactionCode();

        $model->type = $type;
        $model->last_number = '0';
        $model->increment = '1';

        $searchModel = new TransactionCodeSearch();
        $searchModel->type = $type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post())) {

            $transaction = \Yii::$app->db->beginTransaction();

            try {

                if($model->save()){

                    $transaction->commit();    

                    $model = new TransactionCode();
                    $model->type = $type;
                    $model->last_number = '0';
                    $model->increment = '1';

                    // Set success data
                    \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'model' => $model,
                        'transaction_code_help_text' => $transaction_code_help_text
                    ]);

                }

                

            }catch (\Exception $e) {

                \Yii::$app->getSession()->setFlash('success', $e->getMessage());
                $transaction->rollBack();
            }
            
            

        } else {
            
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'transaction_code_help_text' => $transaction_code_help_text
            ]);

        }
    }

    /**
     * Updates an existing TransactionCode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$type='')
    {
        if(isset(\Yii::$app->params[$type]) && !empty(\Yii::$app->params[$type])){            
            $transaction_code_help_text =\Yii::$app->params[$type];
        }else{
            $transaction_code_help_text = '';
        }

        $model = $this->findModel($id);

        $model->type = $type;

        $searchModel = new TransactionCodeSearch();
        $searchModel->type = $type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post())) {

            $transaction = \Yii::$app->db->beginTransaction();

            try {

                if($model->save()){

                    $transaction->commit();    

                    // Set success data
                    \Yii::$app->getSession()->setFlash('success', 'Successfully Updated');
            
                }

                return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'model' => $model,
                        'transaction_code_help_text' => $transaction_code_help_text
                    ]);
                

            }catch (\Exception $e) {

                \Yii::$app->getSession()->setFlash('success', $e->getMessage());
                $transaction->rollBack();
            }
            
            

        } else {
            
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'transaction_code_help_text' => $transaction_code_help_text
            ]);

        }
    }

    /**
     * Deletes an existing TransactionCode model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TransactionCode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransactionCode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransactionCode::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
