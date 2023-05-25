<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\TransSakit;
use app\models\hrd\TransSakitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TranssakitController implements the CRUD actions for TransSakit model.
 */
class TranssakitController extends Controller
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
     * Lists all TransSakit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
        isset($_GET['periode']) ?  $periode = $_GET['periode'] : $periode = $periodeaktif;

        $list_tahun = Yii::$app->db->createCommand("SELECT YEAR(tgl) AS thn 
                        FROM trans_sakit
                        where YEAR(tgl) < 2026
                        GROUP BY YEAR(tgl)")
                      ->queryAll();

        $list_periode = Yii::$app->db->createCommand("SELECT periode 
                        FROM trans_sakit
                        WHERE YEAR(tgl) = '$tahun'
                        GROUP BY periode") 
                    ->queryAll();


        $model = TransSakit::find() 
                ->where("periode='$periode'")
                ->orderBy(['id_sakit' => SORT_DESC])
                ->all(); 

        return $this->render('index', [
            'model' => $model,
            'list_tahun' => $list_tahun, 
            'list_periode' => $list_periode
        ]);
    }

    /**
     * Displays a single TransSakit model.
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
     * Creates a new TransSakit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransSakit();
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
        $model = new TransSakit();
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
            $model = new TransSakit();
            $model->id_karyawan = $post['id_karyawan'];
            $model->periode = $post['periode'];
            $model->keterangan = $post['keterangan'];
            $model->tgl = $tgl;
            $model->save(false);
 
        }
        return $this->redirect(['index']);
           
    }
 
 
    /**
     * Updates an existing TransSakit model.
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
     * Deletes an existing TransSakit model.
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
     * Finds the TransSakit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransSakit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransSakit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
