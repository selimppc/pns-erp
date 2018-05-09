<?php

namespace backend\controllers;

use Yii;
use backend\models\AmCoa;
use backend\models\AmCoaSearch;

use backend\models\TransactionCode;

use backend\models\GroupTwo;
use backend\models\GroupThree;
use backend\models\GroupFour;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\Response;

/**
 * AmCoaController implements the CRUD actions for AmCoa model.
 */
class AmCoaController extends Controller
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
     * Lists all AmCoa models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $searchModel = new AmCoaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize=30;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AmCoa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AmCoa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AmCoa();

        if ($model->load(Yii::$app->request->post()) ) {

            $transaction = \Yii::$app->db->beginTransaction();

            try {

                if($model->save()){
                    $transaction->commit();
                    // Set success data
                    \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted'); 
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{

                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
                

            }catch (\Exception $e) {

                \Yii::$app->getSession()->setFlash('error', $e->getMessage());
                $transaction->rollBack();
            }

            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AmCoa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $transaction = \Yii::$app->db->beginTransaction();

            try {

                if($model->save()){
                    $transaction->commit();   
                    
                    // Set success data
                    \Yii::$app->getSession()->setFlash('success', 'Successfully Updated'); 

                    return $this->redirect(['view', 'id' => $model->id]);

                }else{

                    

                    return $this->render('update', [
                        'model' => $model,
                    ]);

                }
                

            }catch (\Exception $e) {

                \Yii::$app->getSession()->setFlash('error', $e->getMessage());
                $transaction->rollBack();
            }

            
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionFindGroupTwo(){
        if (Yii::$app->request->isAjax) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            $session = Yii::$app->session;
            $response = [];

            $group__one = $_POST['group__one'];

            $group_two_data = GroupTwo::find()->where(['group_one_id' => $group__one])->all();

            if(!empty($group_two_data)){
                
                $response['select_data'] = '<option>-Select-</option>';

                foreach($group_two_data as $group_two){
                    $response['select_data'].='<option value='.$group_two->id.'>'.$group_two->title.'</option>';
                }
                

                $response['result'] = 'success';
            }else{
                $response['result'] = 'error';
            }

            return $response;



        }
     }

    /**
     * Deletes an existing AmCoa model.
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
     * Finds the AmCoa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AmCoa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AmCoa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
