<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\TransAbsensiManual;
use app\models\hrd\TransAbsensiManualSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransabsensimanualController implements the CRUD actions for TransAbsensiManual model.
 */
class TransabsensimanualController extends Controller
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
     * Lists all TransAbsensiManual models.
     * @return mixed
     */

    public function actionIndex()
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
        isset($_GET['periode']) ?  $periode = $_GET['periode'] : $periode = $periodeaktif;

        $list_tahun = Yii::$app->db->createCommand("SELECT YEAR(tgl_absen) AS thn 
                        FROM trans_absensi_manual
                        where YEAR(tgl_absen) < 2026
                        GROUP BY YEAR(tgl_absen)")
                      ->queryAll();

        $list_periode = Yii::$app->db->createCommand("SELECT periode 
                        FROM trans_absensi_manual
                        WHERE YEAR(tgl_absen) = '$tahun'
                        GROUP BY periode") 
                    ->queryAll();

        $model = TransAbsensiManual::find() 
                ->where("periode='$periode'")
                ->orderBy(['id_absensi_manual' => SORT_DESC])
                ->all(); 

        return $this->render('index', [
            'model' => $model,
            'list_tahun' => $list_tahun, 
            'list_periode' => $list_periode
        ]);
    }

    /**
     * Displays a single TransAbsensiManual model.
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
     * Creates a new TransAbsensiManual model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransAbsensiManual();
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

    public function actionCreate2()
    {
        $model = new TransAbsensiManual();
        $listkar = Yii::$app->helperdb->listKaryawan();
        $listperiode = Yii::$app->helperdb->listPeriode();


        return $this->renderAjax('create2', [
            'model' => $model, 
            'listkar' => $listkar,
            'listperiode' => $listperiode,
        ]);
    }

    public function actionUpdate2()
    {
        $post = Yii::$app->request->post();
        
        $begin = new \DateTime($post['tgl_mulai']);
        $end   = new \DateTime($post['tgl_selesai']);
        
        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $tgl = $i->format("Y-m-d");
            $model = new TransAbsensiManual();
            $model->id_karyawan = $post['id_karyawan'];
            $model->periode = $post['periode'];
            $model->keterangan = $post['keterangan'];
            $model->in = $post['in'];
            $model->out = $post['out'];
            $model->tgl_absen = $tgl;
            $model->save(false);
        }
        return $this->redirect(['index']);
           
    }

    /**
     * Updates an existing TransAbsensiManual model.
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
     * Deletes an existing TransAbsensiManual model.
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
     * Finds the TransAbsensiManual model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransAbsensiManual the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransAbsensiManual::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
