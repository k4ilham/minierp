<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\TransTunjanganLain;
use app\models\hrd\TransTunjanganLainSearch;
use app\models\hrd\MasterKaryawan;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TranstunjanganlainController implements the CRUD actions for TransTunjanganLain model.
 */
class TranstunjanganlainController extends Controller
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
     * Lists all TransTunjanganLain models.
     * @return mixed
     */
    public function actionIndex()
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
        isset($_GET['periode']) ?  $periode = $_GET['periode'] : $periode = $periodeaktif;

        $list_tahun = Yii::$app->db->createCommand("SELECT YEAR(tgl) AS thn 
                        FROM trans_tunjangan_lain
                        where YEAR(tgl) < 2026
                        GROUP BY YEAR(tgl)")
                     ->queryAll();

        $list_periode = Yii::$app->db->createCommand("SELECT periode 
                        FROM trans_tunjangan_lain
                        WHERE YEAR(tgl) = '$tahun'
                        GROUP BY periode")
                    ->queryAll();


        $model = TransTunjanganLain::find()
                ->where("periode='$periode'")
                ->orderBy(['id_tunjangan_lain' => SORT_DESC])
                ->all(); 

        return $this->render('index', [
            'model' => $model,
            'list_tahun' => $list_tahun,
            'list_periode' => $list_periode
        ]);
    }

    /**
     * Displays a single TransTunjanganLain model.
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
     * Creates a new TransTunjanganLain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransTunjanganLain();
        $listkar = Yii::$app->helperdb->listKaryawan();
        $listperiode = Yii::$app->helperdb->listPeriode();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'listkar' => $listkar,
            'listperiode' => $listperiode,
        ]);
    } 

    /**
     * Updates an existing TransTunjanganLain model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $listkar = Yii::$app->helperdb->listKaryawan();
        $listperiode = Yii::$app->helperdb->listPeriode();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
            'listkar' => $listkar,
            'listperiode' => $listperiode,
        ]);
    }

    /**
     * Deletes an existing TransTunjanganLain model.
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
     * Finds the TransTunjanganLain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransTunjanganLain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransTunjanganLain::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
