<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\Transperiode;
use app\models\hrd\TransperiodeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * TransperiodeController implements the CRUD actions for Transperiode model.
 */
class TransperiodeController extends Controller
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
     * Lists all Transperiode models.
     * @return mixed
     */


    public function actionIndex()
    {
        
        isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
        isset($_GET['bulan']) ?  $bulan = $_GET['bulan'] : $bulan = date('m');

        $list_tahun = Yii::$app->db->createCommand('SELECT YEAR(tgl_gaji) AS thn 
                        FROM trans_periode
                        where YEAR(tgl_gaji) < 2026
                        GROUP BY YEAR(tgl_gaji)')
                     ->queryAll();


        $model = Transperiode::find()
                ->where("year(tgl_gaji)='$tahun'")
                ->orderBy(['id_periode' => SORT_DESC])
                ->all(); 

        return $this->render('index', [
            'model' => $model,
            'list_tahun' => $list_tahun,
        ]);
    }


    public function actionBackperiode() 
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        $periodelalu = Yii::$app->fungsi->cariPeriode($periodeaktif)['periodelalu'];
        $periodedepan = Yii::$app->fungsi->cariPeriode($periodeaktif)['periodedepan'];

        $ada = Transperiode::find()
        ->where("periode='$periodelalu'")
        ->all(); 
        if($ada){
            // ubah periode jadi 0
            $query="UPDATE trans_periode SET aktif=0;";
            $row = Yii::$app->db->createCommand($query)->execute();
            // pindah  periode lalu
            $query="UPDATE trans_periode SET aktif=1 where periode='$periodelalu';";
            $row = Yii::$app->db->createCommand($query)->execute();
        }
        
        return $this->redirect(['index']);
    }

    public function actionNextperiode() 
    {
 
  
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        $periodelalu = Yii::$app->fungsi->cariPeriode($periodeaktif)['periodelalu'];
        $periodedepan = Yii::$app->fungsi->cariPeriode($periodeaktif)['periodedepan'];

        $ada = Transperiode::find()
        ->where("periode='$periodedepan'")
        ->all(); 
        if($ada){
                // ubah periode jadi 0
                $query="UPDATE trans_periode SET aktif=0;";
                $row = Yii::$app->db->createCommand($query)->execute();
                // pindah  periode lalu
                $query="UPDATE trans_periode SET aktif=1 where periode='$periodedepan';";
                $row = Yii::$app->db->createCommand($query)->execute();
        }

        

        return $this->redirect(['index']);
    }

    public function actionPindahperiode() 
    {

        //empty tabel per periode aktif
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        $periodelalu = Yii::$app->fungsi->cariPeriode($periodeaktif)['periodelalu'];
        //$query="DELETE FROM trans_gaji_history WHERE periode='$periodelalu'";
        //$row = Yii::$app->db->createCommand($query)->execute();

        $gaji = TransGajiHistory::find()
        ->where("periode='$periodelalu'")
        ->orderBy('id_gaji ASC')
        ->all();
        if($gaji){
            //empty tabel
            $tabelgaji = new TransGaji();
            $tabelgaji::deleteAll();
            foreach($gaji as $row){
                $model = new TransGaji();
                $model->periode = $row->periode;
                $model->id_karyawan = $row->id_karyawan;
                $model->gapok = $row->gapok;

                $model->uang_kehadiran = $row->uang_kehadiran;
                $model->uang_lembur = $row->uang_lembur;

                $model->tunj_masakerja = $row->tunj_masakerja;
                $model->tunj_jabatan = $row->tunj_jabatan;
                $model->tunj_keahlian = $row->tunj_keahlian;
                $model->tunj_lain = $row->tunj_lain;

                $model->pot_kedisplinan = $row->pot_kedisplinan;
                $model->pot_lain = $row->pot_lain;

                $model->bpjskes = $row->bpjskes;
                $model->bpjstk = $row->bpjstk;
                $model->pensiun = $row->pensiun;

                $model->total1 = $row->total1;
                $model->total2 = $row->total2;

                $model->total_pendapatan = $row->total_pendapatan;
                $model->total_potongan = $row->total_potongan;
                $model->gaji_bersih = $row->gaji_bersih;

                //bank
                $model->id_bank = $row->id_bank;
                $model->norek = $row->norek;
                $model->atasnama = $row->atasnama;
                $model->cabangbank = $row->cabangbank;
                $model->kotabank = $row->kotabank;

                //detail karyawan
                $model->id_departemen = $row->id_departemen;
                $model->id_jabatan = $row->id_jabatan;
                $model->id_status = $row->id_status;
                $model->menikah = $row->menikah;
                $model->jml_anak = $row->jml_anak;
                $model->jml_tanggungan = $row->jml_tanggungan;
                $model->save(false);
            }

            // ubah periode jadi 0
            $query="UPDATE trans_periode SET aktif=0;";
            $row = Yii::$app->db->createCommand($query)->execute();

            // pindah  periode lalu
            $query="UPDATE trans_periode SET aktif=1 where periode='$periodelalu';";
            $row = Yii::$app->db->createCommand($query)->execute();
        }

        return $this->redirect(['index']);
    }

    /**
     * Displays a single Transperiode model.
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
     * Creates a new Transperiode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transperiode();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $post =Yii::$app->request->post('Transperiode');
            // ubah periode jadi 0
            $query="UPDATE trans_periode SET aktif=0;";
            $row = Yii::$app->db->createCommand($query)->execute();
            //cari tgl
            $periode = $post['periode'];
            $tahun = substr($periode,0,4);
            $bulan = substr($periode,5,2);

            $akhir_bulan = Yii::$app->fungsi->getTglAkhirBulan($bulan);
            $periodelalu = Yii::$app->fungsi->cariPeriode($periode)['periodelalu'];
            $periodedepan = Yii::$app->fungsi->cariPeriode($periode)['periodedepan'];
            $bulanlalu = Yii::$app->fungsi->cariBulan($periode)['bulanlalu'];
            $bulandepan = Yii::$app->fungsi->cariBulan($periode)['bulandepan'];

            $tgl_gaji = $periode . '-' . $akhir_bulan;
            $tgl_absen_awal = $periodelalu . '-16';
            $tgl_absen_akhir = $periode . '-15'; 

            $model->tgl_gaji = $tgl_gaji;
            $model->tgl_absen_awal = $tgl_absen_awal;
            $model->tgl_absen_akhir = $tgl_absen_akhir;
            $model->aktif = '1';
            $model->save(false);

            Yii::$app->helperdb->saveLog("create : ". $periode);
            return $this->redirect(['index']);

        }else{
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }


    }

    /**
     * Updates an existing Transperiode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->helperdb->saveLog("create : ". $model->periode);
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Transperiode model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->helperdb->saveLog("delete : ". $id);
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Transperiode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transperiode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transperiode::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
