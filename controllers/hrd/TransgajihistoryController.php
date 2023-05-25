<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\MasterDepartemen;
use app\models\hrd\MasterStatus;
use app\models\hrd\MasterJabatan;
use app\models\hrd\MasterLokasi;
use app\models\hrd\MasterBank;
use app\models\hrd\MasterCabang;
use app\models\hrd\MasterGroup;

use app\models\hrd\TransGajiHistory;
use app\models\hrd\TransGajiHistorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException; 
use yii\filters\VerbFilter;

/**
 * TransgajihistoryController implements the CRUD actions for TransGajiHistory model.
 */
class TransgajihistoryController extends Controller
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
     * Lists all TransGajiHistory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
        isset($_GET['periode']) ?  $periode = $_GET['periode'] : $periode = $periodeaktif;

        $list_tahun = Yii::$app->db->createCommand("SELECT LEFT(periode,4) AS thn 
                        FROM trans_gaji_history
                        where LEFT(periode,4) < 2026
                        GROUP BY LEFT(periode,4)")
                     ->queryAll();

        $list_periode = Yii::$app->db->createCommand("SELECT periode 
                        FROM trans_gaji_history
                        WHERE LEFT(periode,4) = '$tahun'
                        GROUP BY periode")
                    ->queryAll();

        $model = TransGajiHistory::find()
                ->where("periode='$periode'")
                ->orderBy(['id_gaji' => SORT_ASC])
                ->all(); 

        return $this->render('index', [
            'model' => $model,
            'list_tahun' => $list_tahun,
            'list_periode' => $list_periode
        ]);
    }


    public function actionDashboard()
    {

            $periodeaktif = Yii::$app->helperdb->periodeAktif();
            isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
            isset($_GET['periode']) ?  $periode = $_GET['periode'] : $periode = $periodeaktif;

            $list_tahun = Yii::$app->db->createCommand("SELECT YEAR(tgl_lembur) AS thn 
                            FROM trans_lembur
                            where YEAR(tgl_lembur) < 2026
                            GROUP BY YEAR(tgl_lembur)")
                            ->queryAll();

            $list_periode = Yii::$app->db->createCommand("SELECT periode 
                            FROM trans_lembur
                            WHERE YEAR(tgl_lembur) = '$tahun'
                            GROUP BY periode")
                            ->queryAll();

            $listdepartemen = MasterDepartemen::find()
            ->orderBy(['id_departemen' => SORT_DESC])
            ->all();

            $liststatus = MasterStatus::find()
            ->orderBy(['id_status' => SORT_ASC])
            ->all();

            $listjabatan = MasterJabatan::find()
            ->orderBy(['id_jabatan' => SORT_ASC])
            ->all();

            $listlokasi = MasterLokasi::find()
            ->orderBy(['id_lokasi' => SORT_ASC]) 
            ->all();

            $listbank = MasterBank::find()
            ->orderBy(['id_bank' => SORT_ASC]) 
            ->all();

            $listgroup = MasterGroup::find()
            ->orderBy(['id_group' => SORT_ASC]) 
            ->all();

            $listcabang = MasterCabang::find()
            ->orderBy(['id_cabang' => SORT_ASC]) 
            ->all();

            $listAktif = ['1','0'];

            $listUmur = [
                '1','2','3','4','5'
            ];

            $listMasaKerja = [
                '0','1','2','3','4','5','6','7','8','9'
            ]; 

            $listJenisKelamin = [
                '0','1'
            ];  

            $listAgama = [
                'ISLAM','PROTESTAN','KATOLIK','HINDU','BUDHA','KHONGHUCU'
            ];  
            
            return $this->render('dashboard',[
                'list_tahun' => $list_tahun,
                'list_periode' => $list_periode,
                'listdepartemen' => $listdepartemen,
                'liststatus' => $liststatus,
                'listjabatan' => $listjabatan,
                'listlokasi' => $listlokasi,
                'listbank' => $listbank,
                'listgroup' => $listgroup,
                'listcabang' => $listcabang,
                'listAktif' => $listAktif,
                'listUmur' => $listUmur,
                'listMasaKerja' => $listMasaKerja,
                'listJenisKelamin' => $listJenisKelamin,
                'listAgama' => $listAgama,
            ]);
       
    }

    /**
     * Displays a single TransGajiHistory model.
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
     * Creates a new TransGajiHistory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransGajiHistory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_gaji]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TransGajiHistory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_gaji]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TransGajiHistory model.
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
     * Finds the TransGajiHistory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransGajiHistory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransGajiHistory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
