<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\TransGaji;
use app\models\hrd\TransGajiHistory;
use app\models\hrd\TransGajiSearch;
use app\models\hrd\MasterKaryawan;
use app\models\hrd\Transperiode;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;
use kartik\mpdf\Pdf;
 
/**
 * TransgajiController implements the CRUD actions for TransGaji model.
 */
class TransgajiController extends Controller
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
     * Lists all TransGaji models.
     * @return mixed
     */
    public function actionIndex() 
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        $model = TransGaji::find()
                ->where("periode='$periodeaktif'")
                ->orderBy(['id_gaji' => SORT_ASC])
                ->all(); 

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionPosting() 
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        $model = TransGaji::find()
                ->where("periode='$periodeaktif'")
                ->orderBy(['id_gaji' => SORT_ASC])
                ->all(); 

        return $this->render('posting', [
            'model' => $model,
        ]);
    }

    public function actionClosebook() 
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        $model = TransGaji::find()
                ->where("periode='$periodeaktif'")
                ->orderBy(['id_gaji' => SORT_ASC])
                ->all(); 

        return $this->render('closebook', [
            'model' => $model,
        ]);
    }

    public function actionAnggarangaji() 
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        $model = TransGaji::find()
                ->where("periode='$periodeaktif'")
                ->orderBy(['id_gaji' => SORT_ASC])
                ->all(); 

        return $this->renderPartial('anggarangajidetail', [
            'model' => $model,
        ]);
    }


    public function actionPrint($id) 
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        $model = TransGaji::find()
                ->where("id_gaji='$id'")
                ->One(); 

        //var_dump($model);

        // return $this->renderPartial('print', [
        //     'model' => $model,
        // ]);

        $content = $this->renderPartial('print', [
            'model' => $model,			
        ]);
        
        $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8,
                'format' => Pdf::FORMAT_A4, 
                'orientation' => Pdf::ORIENT_PORTRAIT, 
                'destination' => Pdf::DEST_BROWSER, 
                'content' => $content,  
                'options' => ['title' => 'Slip Gaji'],
                'methods' => [ 
                    'SetHeader'=>[''], 
            ]
        ]);
        return $pdf->render(); 
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


    public function actionPindahgaji() 
    {

        //empty tabel per periode aktif
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        $query="DELETE FROM trans_gaji_history WHERE periode='$periodeaktif'";
        $row = Yii::$app->db->createCommand($query)->execute();

        $gaji = TransGaji::find()
        ->orderBy('id_gaji ASC')
        ->all();
        if($gaji){
            foreach($gaji as $row){
                $model = new TransGajiHistory();
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
            //empty tabel
            $tabelgaji = new TransGaji();
            $tabelgaji::deleteAll();

            // ubah periode jadi 0
            $query="UPDATE trans_periode SET aktif=0;";
            $row = Yii::$app->db->createCommand($query)->execute();

            // pindah next periode
            //$query="UPDATE trans_periode SET aktif=1 where periode='$nextperiod';";
            //$row = Yii::$app->db->createCommand($query)->execute();

            // Tambah periode
            $periode = Yii::$app->fungsi->cariPeriode($periodeaktif)['periodedepan'];
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

            $newperiod = new Transperiode();
            $newperiod->periode = $periode;
            $newperiod->tgl_gaji = $tgl_gaji;
            $newperiod->tgl_absen_awal = $tgl_absen_awal;
            $newperiod->tgl_absen_akhir = $tgl_absen_akhir;
            $newperiod->aktif = '1';
            $newperiod->save(false);
        }

        return $this->redirect(['index']);
    }

    public function actionUpdategaji() 
    {
        echo "Loading...";
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        
        //empty tabel
        $tabelgaji = new TransGaji();
        $tabelgaji::deleteAll();
        //karyawan aktif
        $kar = MasterKaryawan::find()
        ->where(['aktif' => 1])
        ->orderBy('Nama_Karyawan ASC')
        ->all();
        if($kar){
            foreach($kar as $row){
                //save gaji
                $row->gapok ? $gapok=$row->gapok : $gapok=0;
                $row->rate_kehadiran ? $rate_kehadiran=$row->rate_kehadiran : $rate_kehadiran=0;

                $tunj_jabatan= Yii::$app->helperdb->sumTjJabatan($row->id_karyawan); 
                $tunj_keahlian= Yii::$app->helperdb->sumTjKeahlian($row->id_karyawan); 

                    $total1 = $gapok + $tunj_jabatan + $tunj_keahlian;

                $hadir = Yii::$app->helperdb->jumlahKehadiranPeriode($periodeaktif,$row->id_karyawan); 
                $uang_kehadiran= $hadir * $rate_kehadiran;
                $uang_lembur= Yii::$app->helperdb->sumLemburPeriode($periodeaktif,$row->id_karyawan);
                $tunj_masakerja= Yii::$app->helperdb->sumTjMasaKerja($row->id_karyawan); 
                $tunj_lain=Yii::$app->helperdb->sumTjLain($periodeaktif,$row->id_karyawan);

                    $total2 = $uang_kehadiran + $uang_lembur + $tunj_masakerja + $tunj_lain;
                    $total_pendapatan = $total1 + $total2;

                $pot_kedisplinan= Yii::$app->helperdb->sumPotKedisplinan($periodeaktif,$row->id_karyawan);
                $pot_lain= Yii::$app->helperdb->sumPotLain($periodeaktif,$row->id_karyawan);

                

                //bpjs kesehatan
                $umr = Yii::$app->helperdb->getPengaturan()->umr;
                $max_bpjskes = Yii::$app->helperdb->getPengaturan()->max_bpjskes;
                $persen_bpjskes_kar = Yii::$app->helperdb->getPengaturan()->persen_bpjskes_kar;
                if($total1>=$max_bpjskes){
                    $bpjskes= round(($persen_bpjskes_kar/100)*$max_bpjskes,0);
                }else if($total1<=$umr){
                    $bpjskes= round(($persen_bpjskes_kar/100)*$umr,0);
                }else{
                    $bpjskes= round(($persen_bpjskes_kar/100)*$total1,0);
                }
                
                
                //bpjs tk
                $umr = Yii::$app->helperdb->getPengaturan()->umr;
                $persen_bpjstk_kar = Yii::$app->helperdb->getPengaturan()->persen_bpjstk_kar;
                if($total1<=$umr){
                    $bpjstk= round(($persen_bpjstk_kar/100)*$umr,0);
                }else{
                    $bpjstk= round(($persen_bpjstk_kar/100)*$total1,0);
                }
                

                //iuran pensiun
                $umr = Yii::$app->helperdb->getPengaturan()->umr;
                $umur_pensiun = Yii::$app->helperdb->getPengaturan()->umur_pensiun;
                $max_pensiun = Yii::$app->helperdb->getPengaturan()->max_pensiun;
                $persen_pensiun_kar = Yii::$app->helperdb->getPengaturan()->persen_pensiun_kar;
                if($total1>=$max_pensiun){
                    $pensiun= round(($persen_pensiun_kar/100)*$max_pensiun,0);
                }else if($total1<=$umr){
                    $pensiun= round(($persen_pensiun_kar/100)*$umr,0);
                }else{
                    $pensiun= round(($persen_pensiun_kar/100)*$total1,0);
                }
                

                    $total_potongan= $pot_kedisplinan + $pot_lain + $bpjskes + $bpjstk + $pensiun; 

                    $gaji_bersih= $total_pendapatan - $total_potongan;

                
                $model = new TransGaji();
                $model->periode = $periodeaktif;
                $model->id_karyawan = $row->id_karyawan;
                $model->gapok = $gapok;

                $model->uang_kehadiran = $uang_kehadiran;
                $model->uang_lembur = $uang_lembur;

                $model->tunj_masakerja = $tunj_masakerja;
                $model->tunj_jabatan = $tunj_jabatan;
                $model->tunj_keahlian = $tunj_keahlian;
                $model->tunj_lain = $tunj_lain;

                $model->pot_kedisplinan = $pot_kedisplinan;
                $model->pot_lain = $pot_lain;

                $model->bpjskes = $bpjskes;
                $model->bpjstk = $bpjstk;
                $model->pensiun = $pensiun;

                $model->total1 = $total1;
                $model->total2 = $total2;

                $model->total_pendapatan = $total_pendapatan;
                $model->total_potongan = $total_potongan;
                $model->gaji_bersih = $gaji_bersih;

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
        }
        

        return $this->redirect(['index']);
    }


    /**
     * Displays a single TransGaji model.
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
     * Creates a new TransGaji model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransGaji();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_gaji]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TransGaji model.
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
     * Deletes an existing TransGaji model.
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
     * Finds the TransGaji model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransGaji the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransGaji::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
