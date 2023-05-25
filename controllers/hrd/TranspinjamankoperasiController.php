<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\TransPinjamanKoperasi;
use app\models\hrd\TransPinjamanKoperasiSearch;
use app\models\hrd\MasterKaryawan;

use yii\web\Controller; 
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TranspinjamankoperasiController implements the CRUD actions for TransPinjamanKoperasi model.
 */
class TranspinjamankoperasiController extends Controller
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
     * Lists all TransPinjamanKoperasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        isset($_GET['aktif']) ?  $aktif = $_GET['aktif'] : $aktif = 1;


        $model = TransPinjamanKoperasi::find()
                 ->where("aktif='$aktif'")
                ->orderBy(['id_pinjaman_koperasi' => SORT_DESC])
                ->all(); 

        return $this->render('index', [
            'model' => $model
        ]);
    }

    /**
     * Displays a single TransPinjamanKoperasi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TransPinjamanKoperasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransPinjamanKoperasi();
        $listkar = Yii::$app->helperdb->listKaryawan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'listkar' => $listkar,  
        ]);
    }

    /**
     * Updates an existing TransPinjamanKoperasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $listkar = Yii::$app->helperdb->listKaryawan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
            'listkar' => $listkar,  
        ]);
    }

    /**
     * Deletes an existing TransPinjamanKoperasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TransPinjamanKoperasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransPinjamanKoperasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransPinjamanKoperasi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
