<?php

namespace app\controllers\crm;

use Yii;
use app\models\crm\MasterCustomer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class MastercustomerController extends Controller
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
     * Lists all MasterCustomer models.
     * @return mixed
     */
    public function actionIndex() 
    {
        $model = MasterCustomer::find()
        ->orderBy(['id_customer' => SORT_DESC])
        ->all();  
        
        return $this->render('index', [
            'model' => $model,
        ]);
    }
 
    /**
     * Displays a single MasterCustomer model.
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
     * Creates a new MasterCustomer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MasterCustomer();

        if ($model->load(Yii::$app->request->post())) {
            $kode_customer = Yii::$app->helperdb->auto_kode_customer();
            $model->kode_customer = $kode_customer;
            $model->save(false);

            //log
            $json = json_encode($model->getAttributes());
            Yii::$app->helperdb->saveLog($json);

            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MasterCustomer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //log
            $json = json_encode($model->getAttributes());
            Yii::$app->helperdb->saveLog($json);

            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MasterCustomer model.
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
     * Finds the MasterCustomer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MasterCustomer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MasterCustomer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
