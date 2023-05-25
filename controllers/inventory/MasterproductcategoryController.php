<?php

namespace app\controllers\inventory;

use Yii;
use app\models\inventory\MasterProductCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class MasterproductcategoryController extends Controller
{
    /** 
     * {@inheritdoc} 
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
     * Lists all MasterProductCategory models.
     * @return mixed
     */
    public function actionIndex() 
    {
        $model = MasterProductCategory::find()
        ->orderBy(['id_product_category' => SORT_DESC])
        ->all();  

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single MasterProductCategory model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        //log
        $json = json_encode($this->findModel($id)->getAttributes());
        Yii::$app->helperdb->saveLog($json);

        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MasterProductCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MasterProductCategory();

        if ($model->load(Yii::$app->request->post())) {
            $model->photo = \yii\web\UploadedFile::getInstance($model, 'photo');
             
            if($model->photo){
                $saveTo = 'file/uploads/product_category/' . $model->photo->baseName . '.' . $model->photo->extension;
                $model->photo->saveAs($saveTo);  
            }

            $model->save(false);

            //log
            $json = json_encode($model->getAttributes());
            Yii::$app->helperdb->saveLog($json);
            
            Yii::$app->session->setFlash('success','Product Category berhasil diupload');
            return $this->redirect(['index']); 
        } 

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MasterProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->photo = \yii\web\UploadedFile::getInstance($model, 'photo');
            
            if($model->photo){
                $saveTo = 'file/uploads/product_category/' . $model->photo->baseName . '.' . $model->photo->extension;
                $model->photo->saveAs($saveTo);  
            }
            $model->save(false);

            //log
            $json = json_encode($model->getAttributes());
            Yii::$app->helperdb->saveLog($json);

            Yii::$app->session->setFlash('success','Product Category berhasil diupload');
            return $this->redirect(['index']); 
        } 

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MasterProductCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        //log
        $json = json_encode($this->findModel($id)->getAttributes());
        Yii::$app->helperdb->saveLog($json);

        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the MasterProductCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MasterProductCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MasterProductCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
