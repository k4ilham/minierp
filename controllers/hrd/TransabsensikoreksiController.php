<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\TransAbsensiKoreksi;
use app\models\hrd\TransAbsensiKoreksiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
 
/**
 * TransabsensikoreksiController implements the CRUD actions for TransAbsensiKoreksi model.
 */
class TransabsensikoreksiController extends Controller
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
     * Lists all TransAbsensiKoreksi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
        isset($_GET['periode']) ?  $periode = $_GET['periode'] : $periode = $periodeaktif;

        $list_tahun = Yii::$app->db->createCommand("SELECT YEAR(tgl_absen) AS thn 
                        FROM trans_absensi_koreksi
                        where YEAR(tgl_absen) < 2026
                        GROUP BY YEAR(tgl_absen)")
                      ->queryAll();

        $list_periode = Yii::$app->db->createCommand("SELECT periode 
                        FROM trans_absensi_koreksi
                        WHERE YEAR(tgl_absen) = '$tahun'
                        GROUP BY periode") 
                    ->queryAll();

        $model = TransAbsensiKoreksi::find() 
                ->where("periode='$periode'")
                ->orderBy(['id_absensi_koreksi' => SORT_DESC])
                ->all(); 

        return $this->render('index', [
            'model' => $model,
            'list_tahun' => $list_tahun, 
            'list_periode' => $list_periode
        ]);
    }

    /**
     * Displays a single TransAbsensiKoreksi model.
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
     * Creates a new TransAbsensiKoreksi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransAbsensiKoreksi();
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
     * Updates an existing TransAbsensiKoreksi model.
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
     * Deletes an existing TransAbsensiKoreksi model.
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
     * Finds the TransAbsensiKoreksi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransAbsensiKoreksi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransAbsensiKoreksi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
