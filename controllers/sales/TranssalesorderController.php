<?php

namespace app\controllers\sales;

use Yii;
use app\models\sales\TransSalesOrderHeader;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class TranssalesorderController extends Controller
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
     * Lists all TransSalesOrderHeader models.
     * @return mixed
     */
    public function actionIndex() 
    {
        $model = TransSalesOrderHeader::find()
        ->orderBy(['id_sales_order_header' => SORT_DESC])
        ->all();  

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single TransSalesOrderHeader model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        Yii::$app->helperdb->saveLog(json_encode($this->findModel($id)->getAttributes()));
        
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TransSalesOrderHeader model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransSalesOrderHeader();
        $listCustomer = Yii::$app->helperdb->listCustomer();
        $listKaryawan = Yii::$app->helperdb->listKaryawan();
        $now = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post())) {
            $kode_sales_order = Yii::$app->helperdb->auto_kode_sales_order();
            $model->kode_sales_order = $kode_sales_order;
            $model->document_date = $now;
            $model->save(false);

            Yii::$app->helperdb->saveLog(json_encode($model->getAttributes()));

            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'listCustomer' => $listCustomer,
            'listKaryawan' => $listKaryawan,
        ]);
    }

    /**
     * Updates an existing TransSalesOrderHeader model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $listCustomer = Yii::$app->helperdb->listCustomer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->helperdb->saveLog(json_encode($model->getAttributes()));
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
            'listCustomer' => $listCustomer,
            'listKaryawan' => $listKaryawan,
        ]);
    }

    /**
     * Deletes an existing TransSalesOrderHeader model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->helperdb->saveLog(json_encode($this->findModel($id)->getAttributes()));
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the TransSalesOrderHeader model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransSalesOrderHeader the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransSalesOrderHeader::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
