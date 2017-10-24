<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\FileHelper;

use backend\models\Product;
use backend\models\ProductSearch;

use backend\models\Currency;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;
use yii\imagine\Image;

use yii\web\Response;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {

        /*$path = Yii::getAlias('@webroot').'/uploads/';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        echo $path;
        exit();*/
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize=30;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post())) {

            $transaction = \Yii::$app->db->beginTransaction();

            try {

                if($model->validate()){

                $model->image = UploadedFile::getInstance($model, 'image');

                if($model->image){

                    // check folder exists & Write
                    $path = Yii::getAlias('@webroot').'/uploads/';
                    FileHelper::createDirectory($path, $mode = 0775, $recursive = true);

                    $path_thumb = Yii::getAlias('@webroot').'/uploads/thumb';
                    FileHelper::createDirectory($path_thumb, $mode = 0775, $recursive = true);


                    // generate image name
                    $image_name = $model->product_code.'-'.$model->image->baseName . '.' . $model->image->extension;

                    // original image upload
                    $model->image->saveAs('uploads/' . $image_name);


                    // thumb image upload
                    Image::thumbnail('@webroot/uploads/'.$image_name, 200, 130)
                    ->save(Yii::getAlias('@webroot').'/uploads/thumb/'.$image_name, ['quality' => 80]);

                    $model->image = $model->product_code.'-'.$model->image->baseName . '.' . $model->image->extension;

                }
                
                $model->save();
            }else{
                print_r($model->getError());
            }

            // Set success data
            \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

                $transaction->commit();

            }catch (\Exception $e) {

                \Yii::$app->getSession()->setFlash('success', $e->getMessage());
                $transaction->rollBack();
            }

            

            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            // Assigned Default data
            $model->group = 10;
            $model->category = 6;
            $model->sell_uom = 11;
            $model->purchase_uom = 11;
            $model->stock_uom = 11;
            $model->currency_id = 1;

            $currency_data = Currency::find()->where(['id'=>$model->currency_id])->one();

            if(!empty($currency_data)){
                $model->exchange_rate = $currency_data->exchange_rate;
            }


            // View Page
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
        $model = $this->findModel($id);

        $old_image = $model->image;

        if ($model->load(Yii::$app->request->post())) {

            $transaction = \Yii::$app->db->beginTransaction();

            try {

                $model->image = UploadedFile::getInstance($model, 'image');

                if(!empty($model->image)){
                    
                    // check folder exists & Write
                    $path = Yii::getAlias('@webroot').'/uploads/';
                    FileHelper::createDirectory($path, $mode = 0777, $recursive = true);

                    $path_thumb = Yii::getAlias('@webroot').'/uploads/thumb';
                    FileHelper::createDirectory($path_thumb, $mode = 0777, $recursive = true);

                    @unlink(\Yii::getAlias('@webroot').'/uploads/'.$old_image);
                    @unlink(\Yii::getAlias('@webroot').'/uploads/thumb/'.$old_image);

                    // generate image name
                    $image_name = $model->product_code.'-'.$model->image->baseName . '.' . $model->image->extension;

                    // original image upload
                    $model->image->saveAs('uploads/' . $image_name);


                    // thumb image upload
                    Image::thumbnail('@webroot/uploads/'.$image_name, 200, 130)
                    ->save(Yii::getAlias('@webroot').'/uploads/thumb/'.$image_name, ['quality' => 80]);

                    $model->image = $model->product_code.'-'.$model->image->baseName . '.' . $model->image->extension;

                }

                $model->save();

                // Set success data
                \Yii::$app->getSession()->setFlash('success', 'Successfully Updated');

            

                $transaction->commit();

                return $this->redirect(['view', 'id' => $model->id]);

            }catch (\Exception $e) {

                \Yii::$app->getSession()->setFlash('success', $e->getMessage());
                $transaction->rollBack();
            }

            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }



    public function actionFindProduct(){
        if (Yii::$app->request->isAjax) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            $session = Yii::$app->session;
            $response = [];

            $product_id = $_POST['product_id'];

            $product_data = Product::find()->where(['id' => $product_id])->one();

            if(!empty($product_data)){
                $response['sell_uom'] = $product_data->sell_uom;
                $response['sell_uom_qty'] = $product_data->sell_uom_qty;
                $response['sell_rate'] = $product_data->cost_price;
                $response['result'] = 'success';
            }else{
                $response['result'] = 'error';
            }

            return $response;

        }
    }


    public function actionViewPopup($id){

        $model = Product::find()->where(['id' => $id])->one();

        if(!empty($model)){

            return Yii::$app->controller->renderPartial('product-modal',[
                'model' => $model
            ]);

        }else{

            return 'Sorry!! Product Not Found';

        }        

    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->delete()){
            // Set success data
            \Yii::$app->getSession()->setFlash('error', 'Successfully Deleted');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
