<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\TransAbsensi;
use app\models\hrd\TransAbsensiTemp;
use app\models\hrd\TransAbsensiSearch;
use app\models\hrd\MasterKaryawan;
use app\models\hrd\MasterKalender;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter; 



/**
 * TransabsensiController implements the CRUD actions for TransAbsensi model.
 */
class TransabsensiController extends Controller
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
     * Lists all TransAbsensi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
        isset($_GET['periode']) ?  $periode = $_GET['periode'] : $periode = $periodeaktif;

        $list_tahun = Yii::$app->db->createCommand("SELECT YEAR(tgl_absen) AS thn 
                        FROM trans_absensi
                        where YEAR(tgl_absen) < 2026
                        GROUP BY YEAR(tgl_absen)")
                     ->queryAll();

        $list_periode = Yii::$app->db->createCommand("SELECT periode 
                        FROM trans_absensi
                        WHERE YEAR(tgl_absen) = '$tahun'
                        GROUP BY periode")
                    ->queryAll();

        $model = TransAbsensi::find()
                ->where("periode='$periode'")
                ->orderBy(['id_absensi' => SORT_DESC])
                ->all(); 

        return $this->render('index', [
            'model' => $model,
            'list_tahun' => $list_tahun,
            'list_periode' => $list_periode
        ]);
    }

    public function actionRatekehadiran()
    {
        $model = MasterKaryawan::find()
                ->where(['aktif' => 1])
                ->orderBy(['nama_karyawan' => SORT_ASC])
                ->all();   
        return $this->render('ratekehadiran', [
            'model' => $model
        ]);  
    } 

    public function actionJamkerja()
    {
        $model = MasterKaryawan::find()
                ->where(['aktif' => 1])
                ->orderBy(['nama_karyawan' => SORT_ASC])
                ->all();   
        return $this->render('jamkerja', [
            'model' => $model
        ]);  
    } 

    public function actionMonitor()
    {

        $listperiode = Yii::$app->helperdb->listPeriode();
        $listkar = Yii::$app->helperdb->listKaryawan();


        $id_karyawan = "";
        $awal = "";
        $akhir = "";
        $periode = "";

        if (Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $id_karyawan = $post['id_karyawan'];
            $awal  = $post['tgl_awal'];
            $akhir = $post['tgl_akhir'];
        }



        $model = Yii::$app->helperdb->rekapAbsen($awal,$akhir,$id_karyawan);

        return $this->render('monitor', [ 
            'model' => $model,
            'listperiode' => $listperiode,
            'listkar' => $listkar,
            'id_karyawan' => $id_karyawan,
            'periode' => $periode,
            'awal' => $awal,
            'akhir' => $akhir,
        ]);  
    }
    
    public function actionMonitor2()
    {

        $listperiode = Yii::$app->helperdb->listPeriode();
        $listkar =['1','2'];

        $id_karyawan = "";
        $periode = "";
        $awal = "";
        $akhir = ""; 
        if (Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $awal = $post['tgl_awal'];
            $akhir = $post['tgl_akhir'];
        }

        $model = MasterKaryawan::find()
                ->where(['aktif' => 1])
                ->orderBy(['nama_karyawan' => SORT_ASC])
                ->all();   

        return $this->render('monitor2', [ 
            'model' => $model,
            'listperiode' => $listperiode,
            'listkar' => $listkar,
            'id_karyawan' => $id_karyawan,
            'periode' => $periode,
            'awal' => $awal,
            'akhir' => $akhir,
        ]);  
    }  

    public function actionRekapkehadiran()
    {
        $model = MasterKaryawan::find()
                ->where(['aktif' => 1])
                ->orderBy(['nama_karyawan' => SORT_ASC])
                ->all();   
        return $this->render('rekapkehadiran', [
            'model' => $model
        ]);   
    } 
    
    public function actionRekapkehadirandetail()
    {
        isset($_GET['periode']) ? $periode = $_GET['periode'] : $periode="";
        $periodeaktif = Yii::$app->helperdb->periodeAktif();

        $per = Yii::$app->helperdb->getTabelPeriode($periodeaktif);
        if($per){
            $awal = $per['tgl_absen_awal'];
            $akhir = $per['tgl_absen_akhir'];
        }else{
            $awal = "";
            $akhir = "";
        }

   
        $query="SELECT * FROM master_kalender
                WHERE tgl between '$awal' and '$akhir'
                ORDER BY tgl asc;";
        $model = Yii::$app->db->createCommand($query)->queryAll();  
        return $this->renderAjax('rekapkehadirandetail', [
            'model' => $model
        ]);  
    }  



    public function actionUploadabsen()
    {
        $model = TransAbsensiTemp::find()
                ->orderBy(['id_absensi' => SORT_DESC])
                ->all();   
        return $this->render('uploadabsen', [
            'model' => $model
        ]);  
    } 

    // public function actionUpload()
    // {
    //    echo "haloo";
    // } 

    public function actionUpdateratekehadiran($id)
    {
        $model = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['ratekehadiran']);
        }

        return $this->renderAjax('update_ratekehadiran', [
            'model' => $model,
        ]);
    }

    public function actionUpdateratejamkerja($id)
    {
        $model = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();
        $listJamKerja = Yii::$app->helperdb->listJamKerja();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['jamkerja']);
        }

        return $this->renderAjax('update_jamkerja', [
            'model' => $model,
            'listJamKerja' => $listJamKerja,
        ]);
    }

    public function actionUpdatejamkerjamassal($id_group,$id_jam_kerja)
    {
        $query="UPDATE master_karyawan
                SET id_jam_kerja='$id_jam_kerja'
                WHERE id_group='$id_group'";
        $row = Yii::$app->db->createCommand($query)->execute();
        return $this->redirect(['jamkerja']);
    }

    public function actionUpload()
    {    

			$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			if(isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
			  
				$arr_file = explode('.', $_FILES['berkas_excel']['name']); 
				$extension = end($arr_file);
				if('csv' == $extension) {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				} else {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				}
				
				$spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);
				$sheetData = $spreadsheet->getActiveSheet()->toArray();
				
				//var_dump($_FILES['berkas_excel']['name']);
				//var_dump($arr_file);
				//var_dump($spreadsheet);
                //var_dump($sheetData);
                for($i = 1;$i < count($sheetData);$i++){
                    $nik = $sheetData[$i]['2'];
                    $tgl_absen = date('Y-m-d',strtotime($sheetData[$i]['5']));

                    $in = date('H:i',strtotime($sheetData[$i]['9']));
                    $out = date('H:i',strtotime($sheetData[$i]['10']));

                    $id_karyawan = Yii::$app->helperdb->getIdKaryawan($nik);
                    $periode = Yii::$app->fungsi->cariPeriodeByTgl($tgl_absen);

                    $model = new TransAbsensiTemp();
                    $model->id_karyawan = $id_karyawan;
                    $model->periode = $periode;
                    $model->tgl_absen = $tgl_absen;
                    $model->in = $in;
                    $model->out = $out;
                    $model->status = 1;
                    $model->id_jam_kerja = 1;
                    $model->save(false);

                }
				
            } //berkas_excel
		return $this->redirect(['uploadabsen']);
    } 


    /**
     * Displays a single TransAbsensi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TransAbsensi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransAbsensi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_absensi]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TransAbsensi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_absensi]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TransAbsensi model.
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

    public function actionDeleteabsenperiod()
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        $query="DELETE FROM trans_absensi
                WHERE periode='$periodeaktif'";
        $row = Yii::$app->db->createCommand($query)->execute();

        return $this->redirect(['index']);
    }

    public function actionDeletetemp($id)
    {
        TransAbsensiTemp::findOne($id)->delete();
        return $this->redirect(['uploadabsen']);
    }

    public function actionDeleteuploadabsensi()
    {
        $query="DELETE FROM trans_absensi_temp";
        $row = Yii::$app->db->createCommand($query)->execute();
        return $this->redirect(['uploadabsen']);
    }


    public function actionSinkronuploadabsensi()
    {

        $absentemp = TransAbsensiTemp::find()
                ->orderBy(['id_absensi' => SORT_DESC])
                ->all(); 
        if($absentemp){
            foreach($absentemp as $row){
                $cari = TransAbsensi::find()
                        ->where(['id_karyawan' => $row->id_karyawan])
                        ->andWhere(['tgl_absen' => $row->tgl_absen])
                        ->one(); 

                if($cari){}else{
                    $model = new TransAbsensi();
                    $model->id_karyawan = $row->id_karyawan;
                    $model->id_jam_kerja = $row->id_jam_kerja;
                    $model->periode = $row->periode;
                    $model->tgl_absen = $row->tgl_absen;
                    $model->in = $row->in;
                    $model->out = $row->out;
                    $model->status = $row->status;
                    $model->save(false);

                    //delete
                    $id_karyawan = $row->id_karyawan;
                    $tgl_absen = $row->tgl_absen;
                    $query="DELETE FROM trans_absensi_temp where id_karyawan='$id_karyawan' and tgl_absen='$tgl_absen'";
                    $row = Yii::$app->db->createCommand($query)->execute();
                }
            }
        }  

        return $this->redirect(['uploadabsen']);
    }


    /**
     * Finds the TransAbsensi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransAbsensi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransAbsensi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
