<?php

namespace app\controllers\sales;

use Yii;
use app\models\sales\TransSalesOrderHeader;
use app\models\sales\TransSalesOrderDetail;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

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

        $detail = TransSalesOrderDetail::find()
        ->where(['id_sales_order_header' => $id])
        ->all();
        
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'detail' => $detail, 
            'id' => $id, 
        ]);
    }

    public function actionDetail($id)
    {
        $detail = TransSalesOrderDetail::find()
        ->where(['id_sales_order_header' => $id])
        ->all();

        return $this->render('detail', [
            'model' => $this->findModel($id), 
            'detail' => $detail, 
            'id' => $id, 
        ]);
    }

    public function actionDetailadd($id)
    {
        $model = new TransSalesOrderDetail();

        $listProduct = Yii::$app->helperdb->listProduct();
        $listKaryawan = Yii::$app->helperdb->listKaryawan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $post = Yii::$app->request->post()['TransSalesOrderDetail'];
            $id_product = $post['id_product'];
            $qty = $post['qty'];
            $price = $post['price'];

            $cari = TransSalesOrderDetail::find()
            ->where(['id_sales_order_header' => $id])
            ->andWhere(['id_product' => $id_product])
            ->one();

            if($cari){
                $qty=$cari->qty+$qty;
                $subtotal=$qty * $price;

                $cari->qty = $qty;
                $cari->price = $price;
                $cari->subtotal = $subtotal;
                $cari->save(false);
            }else{
                $subtotal=$qty * $price;
    
                $model->id_sales_order_header = $id;
                $model->qty = $qty;
                $model->price = $price;
                $model->subtotal = $subtotal;
                $model->save(false);
            }



            Yii::$app->helperdb->saveLog(json_encode($model->getAttributes()));

            $url = Url::base(true) . "/sales/transsalesorder/detail?id=".$id;
            return $this->redirect($url);
        }

        return $this->renderAjax('detailadd', [
            'model' => $model,
            'listProduct' => $listProduct,
            'listKaryawan' => $listKaryawan,
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
        $listKaryawan = Yii::$app->helperdb->listKaryawan();

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

    public function actionStatusOpen($id)
    {
        $model = $this->findModel($id);
        $model->status = 0;
        $model->posting_date = null;
        $model->save(false);
        Yii::$app->helperdb->saveLog(json_encode($model->getAttributes()));
        return $this->redirect(['index']);
    }

    public function actionStatusComplete($id)
    {
        $model = $this->findModel($id);
        $model->status = 1;
        $model->posting_date = date("Y-m-d H:i:s");
        $model->save(false);
        Yii::$app->helperdb->saveLog(json_encode($model->getAttributes()));
        return $this->redirect(['index']);
    }


    public function actionStatusVoid($id)
    {
        $model = $this->findModel($id);
        $model->status = 2;
        $model->posting_date = date("Y-m-d H:i:s");
        $model->save(false);
        Yii::$app->helperdb->saveLog(json_encode($model->getAttributes()));
        return $this->redirect(['index']);
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
