<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post()))
        {

            $model->status = 10;
            $valid = $model->validate();

            if($valid){
                // set hash password
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
                $model->repeat_password = $model->password;
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {

                if ($model->save())
                {
                    $transaction->commit();

                    // Set success data
                    \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

                    return $this->redirect(['view', 'id' => $model->id]);
                }

            } catch (\Exception $e) {

                $transaction->rollBack();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Set success data
            \Yii::$app->getSession()->setFlash('success', 'Successfully Updated');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Password Change an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionChangePassword()
    {
        $user_id = Yii::$app->user->identity->id;
            
        $model = User::find()->where(['id' => $user_id])->one();
        $model->scenario = 'change_password';

        if ($model->load(Yii::$app->request->post()) ) {

                $valid_data = $model->validate();

                if($valid_data){
                    $model->password = Yii::$app->security->generatePasswordHash($model->new_password);
                    $model->repeat_password = $model->new_password;
                    

                    if($model->save()){
                        
                        // Set success data
                        \Yii::$app->getSession()->setFlash('success', 'Password has been SUCCESSFULLY changed');

                    }else{

                        // Set error data
                        \Yii::$app->getSession()->setFlash('error', 'Somethings went wrong...');
                        
                    }
                }else{
                    
                    // Set success data
                        \Yii::$app->getSession()->setFlash('error', 'Somethings went wrong...');
                         
                }
            }

            return $this->render('change_password', [
                'model' => $model,
            ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
