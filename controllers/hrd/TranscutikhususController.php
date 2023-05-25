<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\TransCutiKhusus;
use app\models\hrd\TranCutiKhususSearch;
use yii\web\Controller; 
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TranscutikhususController implements the CRUD actions for TransCutiKhusus model.
 */
class TranscutikhususController extends Controller
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
     * Lists all TransCutiKhusus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
        isset($_GET['periode']) ?  $periode = $_GET['periode'] : $periode = $periodeaktif;

        $list_tahun = Yii::$app->db->createCommand("SELECT YEAR(tgl_awal) AS thn 
                        FROM trans_cuti_khusus
                        where YEAR(tgl_awal) < 2026
                        GROUP BY YEAR(tgl_awal)")
                      ->queryAll();

        $list_periode = Yii::$app->db->createCommand("SELECT periode 
                        FROM trans_cuti_khusus
                        WHERE YEAR(tgl_awal) = '$tahun'
                        GROUP BY periode") 
                    ->queryAll();


        $model = TransCutiKhusus::find() 
                ->where("periode='$periode'")
                ->orderBy(['id_cuti_khusus' => SORT_DESC])
                ->all(); 

        return $this->render('index', [
            'model' => $model,
            'list_tahun' => $list_tahun, 
            'list_periode' => $list_periode
        ]);
    }


    public function actionCreate2()
    {
        $model = new TransCutiKhusus();
        $listkar = Yii::$app->helperdb->listKaryawan();
        $listperiode = Yii::$app->helperdb->listPeriode();
        $listmastercutikhusus = Yii::$app->helperdb->listMasterCutiKhusus();


        return $this->renderAjax('create2', [
            'model' => $model, 
            'listkar' => $listkar,
            'listperiode' => $listperiode,
            'listmastercutikhusus' => $listmastercutikhusus,
        ]);
    }

    public function actionUpdate2()
    {
        $post = Yii::$app->request->post();
        
        $begin = new \DateTime($post['tgl_awal']);
        $end   = new \DateTime($post['tgl_akhir']);
        $difference = $begin->diff($end);
        $jml_hari = $difference->d;

        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $tgl = $i->format("Y-m-d");
            $model = new TransCutiKhusus();
            $model->id_karyawan = $post['id_karyawan'];
            $model->periode = $post['periode'];
            $model->keterangan = $post['keterangan'];
            $model->saldo_cuti = 0;
            $model->saldo_cuti_lalu = 0;
            $model->tgl_awal = $tgl;
            $model->tgl_akhir = $tgl;
            $model->jenis_cuti = $post['jenis_cuti'];
            $model->jml_hari = $jml_hari+1;
            $model->save(false);
            }
        return $this->redirect(['index']);
           
    }    

    /**
     * Displays a single TransCutiKhusus model.
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
     * Creates a new TransCutiKhusus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransCutiKhusus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TransCutiKhusus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TransCutiKhusus model.
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
     * Finds the TransCutiKhusus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransCutiKhusus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransCutiKhusus::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
