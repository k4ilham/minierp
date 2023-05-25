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

use app\models\hrd\MasterKaryawan;
use app\models\hrd\MasterKaryawanTemp;
use app\models\hrd\MasterKaryawanSearch;
use app\models\hrd\TransKontrak; 
 
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;
use kartik\mpdf\Pdf;

/**
 * MasterkaryawanController implements the CRUD actions for MasterKaryawan model.
 */
class MasterkaryawanController extends Controller
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

    public function actionUploadkaryawan()
    {
        $model = MasterKaryawanTemp::find()
                ->orderBy(['id_karyawan' => SORT_DESC])
                ->all();   
        return $this->render('uploadkaryawan', [
            'model' => $model
        ]);  
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
                //var_dump($sheetData[1]);
                for($i = 1;$i < count($sheetData);$i++){

                    $nik = $sheetData[$i]['0'];
                    $nama_karyawan = $sheetData[$i]['1'];
                    $aktif = $sheetData[$i]['2'];
                    $id_departemen = $sheetData[$i]['3'];
                    $id_group = $sheetData[$i]['4'];
                    $id_jabatan = $sheetData[$i]['5'];
                    $id_status = $sheetData[$i]['6'];
                    $id_lokasi = $sheetData[$i]['7'];
                    $id_cabang = $sheetData[$i]['8'];
                    $id_jam_kerja = $sheetData[$i]['9'];
                    $jk = $sheetData[$i]['10'];

                    $menikah = $sheetData[$i]['11'];
                    $jml_anak = $sheetData[$i]['12'];
                    $jml_tanggungan = $sheetData[$i]['13'];
                    $ibu_kandung = $sheetData[$i]['14'];
                    $tempat_lahir = $sheetData[$i]['15'];
                    $tgl_lahir = $sheetData[$i]['16'];
                    $tgl_masuk = $sheetData[$i]['17'];
                    $kk = $sheetData[$i]['18'];
                    $ktp = $sheetData[$i]['19'];
                    $alamat_ktp = $sheetData[$i]['20'];

                    $kota = $sheetData[$i]['21'];
                    $alamat_tinggal = $sheetData[$i]['22'];
                    $pendidikan = $sheetData[$i]['23'];
                    $agama = $sheetData[$i]['24'];
                    $goldarah = $sheetData[$i]['25'];
                    $nohp1 = $sheetData[$i]['26'];
                    $nohp2 = $sheetData[$i]['27'];
                    $email = $sheetData[$i]['28'];
                    $bpjstk = $sheetData[$i]['29'];
                    $bpjskes = $sheetData[$i]['30'];
                    $npwp = $sheetData[$i]['31'];

    
                    $model = new MasterKaryawanTemp();
                    $model->nik = $nik;
                    $model->aktif = $aktif;
                    $model->nama_karyawan = $nama_karyawan;
                    $model->id_departemen = $id_departemen;
                    $model->id_group = $id_group;
                    $model->id_jabatan = $id_jabatan;
                    $model->id_status = $id_status;
                    $model->id_lokasi = $id_lokasi;
                    $model->id_cabang = $id_cabang;
                    $model->id_jam_kerja = $id_jam_kerja;
                    $model->jk = $jk;
                    $model->menikah = $menikah;
                    $model->jml_anak = $jml_anak;
                    $model->jml_tanggungan = $jml_tanggungan;
                    $model->ibu_kandung = $ibu_kandung;
                    $model->tempat_lahir = $tempat_lahir;
                    $model->tgl_lahir = $tgl_lahir;
                    $model->tgl_masuk = $tgl_masuk;
                    $model->kk = $kk;
                    $model->ktp = $ktp;
                    $model->alamat_ktp = $alamat_ktp;
                    $model->kota = $kota;
                    $model->alamat_tinggal = $alamat_tinggal;
                    $model->pendidikan = $pendidikan;
                    $model->agama = $agama;
                    $model->goldarah = $goldarah;
                    $model->nohp1 = $nohp1;
                    $model->nohp2 = $nohp2;
                    $model->email = $email;
                    $model->bpjstk = $bpjstk;
                    $model->bpjskes = $bpjskes;
                    $model->npwp = $npwp;

                    $model->save(false);

                }
				
            } //berkas_excel
		return $this->redirect(['uploadkaryawan']);
    } 

    /**
     * Lists all MasterKaryawan models.
     * @return mixed
     */
    public function actionIndex()
    {

        $model = MasterKaryawan::find()
                ->where(['aktif' => 1])
                ->orderBy(['id_karyawan' => SORT_ASC])
                ->all(); 

        $id_filter = "Departemen";
        $myfilter = MasterDepartemen::find()
        ->orderBy(['id_departemen' => SORT_ASC])
        ->all();

        if (Yii::$app->request->post()){

            $post = Yii::$app->request->post();
            $id_filter = $post['id_filter'];

            if($id_filter=="Departemen"){
                $myfilter = MasterDepartemen::find()
                ->orderBy(['id_departemen' => SORT_ASC])
                ->all();               
            }else if($id_filter=="Jabatan"){
                $myfilter = MasterJabatan::find()
                ->orderBy(['id_jabatan' => SORT_ASC])
                ->all(); 
            }else if($id_filter=="Group"){
                $myfilter = MasterGroup::find()
                ->orderBy(['id_group' => SORT_ASC])
                ->all();               
            }else if($id_filter=="Status"){
                $myfilter = MasterStatus::find()
                ->orderBy(['id_status' => SORT_ASC])
                ->all();               
            }else if($id_filter=="Lokasi"){
                $myfilter = MasterLokasi::find()
                ->orderBy(['id_lokasi' => SORT_ASC])
                ->all();  
            }else if($id_filter=="Aktif"){
                $myfilter = [
                    '0','1'
                ]; 
            }else if($id_filter=="Bank"){
                $myfilter = MasterBank::find()
                ->orderBy(['id_bank' => SORT_ASC])
                ->all(); 
            }else if($id_filter=="Cabang"){
                $myfilter = Mastercabang::find()
                ->orderBy(['id_cabang' => SORT_ASC])
                ->all(); 
            }else if($id_filter=="Umur"){
                $myfilter = [
                    '1','2','3','4','5'
                ];
            }else if($id_filter=="Masakerja"){
                $myfilter = [
                    '0','1','2','3','4','5','6','7','8','9'
                ]; 
            }else if($id_filter=="Jenis Kelamin"){
                $myfilter = [
                    '0','1'
                ];  
            }else if($id_filter=="All"){
                $myfilter = [
                    'All'
                ]; 
            }else if($id_filter=="Agama"){
                $myfilter = [
                    'ISLAM','PROTESTAN','KATOLIK','HINDU','BUDHA','KHONGHUCU'
                ];           
            }else{
                $myfilter = MasterDepartemen::find()
                ->orderBy(['id_departemen' => SORT_ASC])
                ->all();               
            }

            //tombol yg ditekan
            if (Yii::$app->request->post('tombol')=='filter'){

            }


        }

        return $this->render('index', [
            'model' => $model,
            'id_filter' => $id_filter,
            'myfilter' => $myfilter,
        ]);
    }

    public function actionDashboard()
    {
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

    public function actionReport()
    {
 
        $listDepartemen = Yii::$app->helperdb->listDepartemen();
        $listStatus = Yii::$app->helperdb->listStatus();
        $listJabatan = Yii::$app->helperdb->listJabatan();
        $listLokasi = Yii::$app->helperdb->listLokasi();

        $model = MasterKaryawan::find()
        ->orderBy(['id_departemen' => SORT_ASC])
        ->all();
 
        
        if (Yii::$app->request->post()){

            $post = Yii::$app->request->post();

            $id_departemen = $post['id_departemen'];
            $id_status = $post['id_status'];
            $id_jabatan = $post['id_jabatan'];

            if($id_departemen=="ALL"){
                if($id_status=="ALL"){
                    if($id_jabatan=="ALL"){
                        //dep=ALL , status=ALL, Jab=ALL
                        $model = MasterKaryawan::find()
                        ->orderBy(['id_departemen' => SORT_ASC])
                        ->all();
                    }else{
                        //dep=ALL , status=ALL, Jab=?
                        $model = MasterKaryawan::find()
                        ->where(['id_jabatan' => $id_jabatan])
                        ->orderBy(['id_departemen' => SORT_ASC])
                        ->all();                    
                    }
                }else{ 
                    if($id_jabatan=="ALL"){
                        //dep=ALL , status=?, Jab=ALL
                        $model = MasterKaryawan::find()
                        ->where(['id_status' => $id_status])
                        ->orderBy(['id_departemen' => SORT_ASC])
                        ->all();
                    }else{
                        //dep=ALL , status=?, Jab=?
                        $model = MasterKaryawan::find()
                        ->where(['id_status' => $id_status])
                        ->where(['id_jabatan' => $id_jabatan])
                        ->orderBy(['id_departemen' => SORT_ASC])
                        ->all();                 
                    }                   
                }
            }else{
                if($id_status=="ALL"){
                    if($id_jabatan=="ALL"){
                        //dep=? , status=ALL, Jab=ALL
                        $model = MasterKaryawan::find()
                        ->where(['id_departemen' => $id_departemen ])
                        ->orderBy(['id_departemen' => SORT_ASC])
                        ->all();
                    }else{
                        //dep=? , status=ALL, Jab=?
                        $model = MasterKaryawan::find()
                        ->where(['id_departemen' => $id_departemen ])
                        ->where(['id_jabatan' => $id_jabatan])
                        ->orderBy(['id_departemen' => SORT_ASC])
                        ->all();             
                    }    
                }else{
                    if($id_jabatan=="ALL"){
                        //dep=? , status=?, Jab=ALL
                        $model = MasterKaryawan::find()
                        ->where(['id_departemen' => $id_departemen ])
                        ->where(['id_status' => $id_status ])
                        ->orderBy(['id_departemen' => SORT_ASC])
                        ->all(); 
                    }else{
                        //dep=? , status=?, Jab=?
                        $model = MasterKaryawan::find()
                        ->where(['id_departemen' => $id_departemen ])
                        ->where(['id_status' => $id_status ])
                        ->where(['id_jabatan' => $id_jabatan])
                        ->orderBy(['id_departemen' => SORT_ASC])
                        ->all();            
                    }                     
                }
            }

            //tombol yg ditekan
            if (Yii::$app->request->post('tombol')=='filter'){

            }else if (Yii::$app->request->post('tombol')=='excel'){
                return $this->renderpartial('excel',[
                    'model' => $model
                ]);
            }else if (Yii::$app->request->post('tombol')=='pdf'){
                
                    $content = $this->renderPartial('pdf', [
                        'model' => $model	
                    ]);
                    
                    $pdf = new Pdf([
                            'mode' => Pdf::MODE_UTF8,
                            'format' => Pdf::FORMAT_A4, 
                            'orientation' => Pdf::ORIENT_PORTRAIT, 
                            'destination' => Pdf::DEST_BROWSER, 
                            'content' => $content,  
                            'options' => ['title' => 'Report Karyawan'],
                            'methods' => [ 
                                'SetHeader'=>[''], 
                        ]
                    ]);
                    return $pdf->render(); 
            }
            
        } //post


        return $this->render('report', [
            'model' => $model,
            'listDepartemen' => $listDepartemen,
            'listStatus' => $listStatus,
            'listJabatan' => $listJabatan,
            'listLokasi' => $listLokasi,
        ]);
    }

    public function actionKontrak()
    {
        $model = MasterKaryawan::find()
                ->where(['aktif' => 1])
                ->andwhere(['id_status' => 1])
                ->orderBy(['nama_karyawan' => SORT_ASC])
                ->all();   
        return $this->render('kontrak', [
            'model' => $model
        ]);  
    } 

    public function actionViewkontrak($id)
    {
        $model = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();
        return $this->renderAjax('view_kontrak', [
            'model' => $model
        ]);
    }

    public function actionLogkontrak($id)
    {
        $model = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();
        $log = TransKontrak::find()
               ->where(['id_karyawan' => $id])
               ->orderBy(['id_kontrak' => SORT_DESC])
               ->All();
        return $this->renderAjax('log_kontrak', [
            'model' => $model,
            'log' => $log,
        ]);
    }

    public function actionUpdatekontrak($id)
    {
        $model = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //save log Kontrak
            $TransKontrak = new TransKontrak();
            $TransKontrak->id_karyawan = $model->id_karyawan;
            $TransKontrak->periode_kontrak = $model->periode_kontrak;
            $TransKontrak->bulan_kontrak = $model->bulan_kontrak;
            $TransKontrak->mulai_kontrak = $model->mulai_kontrak;
            $TransKontrak->akhir_kontrak = $model->akhir_kontrak;
            $TransKontrak->save(false);
            return $this->redirect(['kontrak']);
        }

        return $this->renderAjax('update_kontrak', [
            'model' => $model
        ]);
    }
  
    /**
     * Displays a single MasterKaryawan model.
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
     * Creates a new MasterKaryawan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MasterKaryawan();
        $listDepartemen = Yii::$app->helperdb->listDepartemen();
        $listStatus = Yii::$app->helperdb->listStatus();
        $listJabatan = Yii::$app->helperdb->listJabatan();
        $listLokasi = Yii::$app->helperdb->listLokasi();
        $listGroup = Yii::$app->helperdb->listGroup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'listDepartemen' => $listDepartemen,
            'listStatus' => $listStatus,
            'listJabatan' => $listJabatan,
            'listLokasi' => $listLokasi,
            'listGroup' => $listGroup,
        ]);
    }
  
    /**
     * Updates an existing MasterKaryawan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $listDepartemen = Yii::$app->helperdb->listDepartemen();
        $listStatus = Yii::$app->helperdb->listStatus();
        $listJabatan = Yii::$app->helperdb->listJabatan();
        $listLokasi = Yii::$app->helperdb->listLokasi();
        $listGroup = Yii::$app->helperdb->listGroup();
        $listJamKerja = Yii::$app->helperdb->listJamKerja();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [ 
            'model' => $model,
            'listDepartemen' => $listDepartemen,
            'listStatus' => $listStatus,
            'listJabatan' => $listJabatan,
            'listLokasi' => $listLokasi,
            'listGroup' => $listGroup,
            'listJamKerja' => $listJamKerja,
        ]);
    }

    /**
     * Deletes an existing MasterKaryawan model.
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

    public function actionDeletetemp($id)
    {
        MasterKaryawanTemp::findOne($id)->delete();

        return $this->redirect(['uploadkaryawan']);
    }

    public function actionDeleteuploadkaryawan()
    {
        $query="DELETE FROM master_karyawan_temp";
        $row = Yii::$app->db->createCommand($query)->execute();
        return $this->redirect(['uploadkaryawan']);
    }

    public function actionSinkronuploadkaryawan()
    {

        $kartemp = MasterKaryawanTemp::find()
                ->orderBy(['id_karyawan' => SORT_DESC])
                ->all(); 
        if($kartemp){
            foreach($kartemp as $row){
                $cari = MasterKaryawan::find()->where(['nik' => $row->nik])->one(); 
                if($cari){}else{
                    $model = new MasterKaryawan();
                    $model->nik = $row->nik;
                    $model->nama_karyawan = $row->nama_karyawan;

                    $model->aktif = $row->aktif;
                    $model->id_departemen = $row->id_departemen;
                    $model->id_group = $row->id_group;
                    $model->id_jabatan = $row->id_jabatan;
                    $model->id_status = $row->id_status;
                    $model->id_lokasi = $row->id_lokasi;
                    $model->id_cabang = $row->id_cabang;
                    $model->id_jam_kerja = $row->id_jam_kerja;
                    $model->jk = $row->jk;

                    $model->menikah = $row->menikah;
                    $model->jml_anak = $row->jml_anak;
                    $model->jml_tanggungan = $row->jml_tanggungan;
                    $model->ibu_kandung = $row->ibu_kandung;
                    $model->tempat_lahir = $row->tempat_lahir;
                    $model->tgl_lahir = $row->tgl_lahir;
                    $model->tgl_masuk = $row->tgl_masuk;
                    $model->kk = $row->kk;
                    $model->ktp = $row->ktp;
                    $model->alamat_ktp = $row->alamat_ktp;

                    $model->kota = $row->kota;
                    $model->alamat_tinggal = $row->alamat_tinggal;
                    $model->pendidikan = $row->pendidikan;
                    $model->agama = $row->agama;
                    $model->goldarah = $row->goldarah;
                    $model->nohp1 = $row->nohp1;
                    $model->nohp2 = $row->nohp2;
                    $model->email = $row->email;
                    $model->bpjstk = $row->bpjstk;
                    $model->bpjskes = $row->bpjskes;
                    $model->npwp = $row->npwp;
        
                    $model->save(false);

                    //delete
                    $nik = $row->nik;
                    $query="DELETE FROM master_karyawan_temp where nik='$nik'";
                    $row = Yii::$app->db->createCommand($query)->execute();
                }
            }
        }  

        return $this->redirect(['uploadkaryawan']);
    }

    /**
     * Finds the MasterKaryawan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MasterKaryawan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MasterKaryawan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
