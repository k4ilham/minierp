<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\MasterKaryawan;
use app\models\hrd\TransCuti;
use app\models\hrd\TransCutiSearch; 
use yii\web\Controller;
use yii\web\NotFoundHttpException; 
use yii\filters\VerbFilter;
use yii\web\Response;
use aryelds\sweetalert\SweetAlert;

/**
 * TranscutiController implements the CRUD actions for TransCuti model.
 */
class TranscutiController extends Controller
{

    public function beforeAction($action) {     
        $this->enableCsrfValidation = false;     
        return parent::beforeAction($action); 
    }
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
     * Lists all TransCuti models.
     * @return mixed
     */
    public function actionIndex()
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
        isset($_GET['periode']) ?  $periode = $_GET['periode'] : $periode = $periodeaktif;

        $list_tahun = Yii::$app->db->createCommand("SELECT YEAR(tgl_awal) AS thn 
                        FROM trans_cuti
                        where YEAR(tgl_awal) < 2026
                        GROUP BY YEAR(tgl_awal)")
                      ->queryAll();

        $list_periode = Yii::$app->db->createCommand("SELECT periode 
                        FROM trans_cuti
                        WHERE YEAR(tgl_awal) = '$tahun'
                        GROUP BY periode")
                    ->queryAll();


        $model = TransCuti::find() 
                ->where("periode='$periode'")
                ->orderBy(['id_cuti' => SORT_DESC])
                ->all(); 

        return $this->render('index', [
            'model' => $model,
            'list_tahun' => $list_tahun, 
            'list_periode' => $list_periode
        ]);
    }

    //api saldo cuti
	public function actionApiSaldocuti($id){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = array();
        $model = MasterKaryawan::find()
                ->where(['id_karyawan' => $id])
                ->one(); 
        if($model){
            $data['status'] = 1;
            $data['id'] = $model->id_karyawan;
            $data['nik'] = $model->nik;
            $data['nama'] = $model->nama_karyawan;
            $data['saldo_cuti'] = $model->saldo_cuti;
            $data['saldo_cuti_lalu'] = $model->saldo_cuti_lalu;
        }else{
            $data['status'] = 0;
            $data['id'] = "";
            $data['nik'] = "";
            $data['nama'] = "";
            $data['saldo_cuti'] = 0;
            $data['saldo_cuti_lalu'] = 0;
        }
        return $data;		
	}


    public function actionSaldocuti()
    {
        $model = MasterKaryawan::find()
                ->where(['aktif' => 1])
                ->orderBy(['nama_karyawan' => SORT_ASC])
                ->all();   
        return $this->render('saldocuti', [
            'model' => $model
        ]);  
    } 

    public function actionCutiawaltahun()
    {
        $model = MasterKaryawan::find()
                ->where(['aktif' => 1])
                ->orderBy(['nama_karyawan' => SORT_ASC])
                ->all(); 
        if($model){
            foreach($model as $r){
                $id_karyawan = $r->id_karyawan;
                $saldo_cuti_lalu = $r->saldo_cuti;
                $saldo_cuti = 12;
 
                $updkar = MasterKaryawan::find()
                          ->where(['id_karyawan' => $id_karyawan])
                          ->one();
                $updkar->saldo_cuti_lalu = $saldo_cuti_lalu;
                $updkar->saldo_cuti = $saldo_cuti;
                $updkar->save(false);
            }
        }       
        return $this->redirect(['saldocuti']); 
          
    } 

    public function actionResetcutitahunlalu()
    {
        $model = MasterKaryawan::find()
                ->where(['aktif' => 1])
                ->orderBy(['nama_karyawan' => SORT_ASC])
                ->all(); 
        if($model){
            foreach($model as $r){
                $id_karyawan = $r->id_karyawan;
                $updkar = MasterKaryawan::find()
                          ->where(['id_karyawan' => $id_karyawan])
                          ->one();
                $updkar->saldo_cuti_lalu = 0;
                $updkar->save(false);
            }
        }
        

        return $this->redirect(['saldocuti']); 
          
    } 

    /**
     * Displays a single TransCuti model.
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
     * Creates a new TransCuti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransCuti();
        $listkar = Yii::$app->helperdb->listKaryawan();
        $listperiode = Yii::$app->helperdb->listPeriode();

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post()['TransCuti'];


            $id_karyawan = $post['id_karyawan'];
            $jml_hari = $post['jml_hari'];

            $jenis_cuti = $post['jenis_cuti'];
            $updkar = MasterKaryawan::find()
            ->where(['id_karyawan' => $id_karyawan])
            ->one();
            
    
            if($jenis_cuti=="TAHUN1"){
                if($updkar->saldo_cuti_lalu < $jml_hari ){}else{
                    //pengurangan cuti
                    $updkar->saldo_cuti_lalu = $updkar->saldo_cuti_lalu - $jml_hari;
                    $updkar->save(false);
                    //save cuti 
                    $model->save(false);
                }
            }else if($jenis_cuti=="TAHUN2"){
                if($updkar->saldo_cuti < $jml_hari ){}else{
                    //pengurangan cuti
                    $updkar->saldo_cuti = $updkar->saldo_cuti - $jml_hari;
                    $updkar->save(false); 
                    //save cuti
                    $model->save(false); 
                }
            }else{
                //cuti khusus tanpa pengurang saldo
                //save cuti
                $model->save(false);
            }
 


            return $this->redirect(['index']);
        }else{
            return $this->renderAjax('create', [
                'model' => $model,
                'listkar' => $listkar,
                'listperiode' => $listperiode,
            ]);            
        }


    }


    public function actionCreate2()
    {
        $model = new TransCuti();
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
        
        $begin = new \DateTime($post['tgl_awal']);
        $end   = new \DateTime($post['tgl_akhir']);
        $difference = $begin->diff($end);
        $jml_hari = $difference->d;

        $jenis_cuti = $post['jenis_cuti'];
        $id_karyawan = $post['id_karyawan'];
        $updkar = MasterKaryawan::find()
        ->where(['id_karyawan' => $id_karyawan])
        ->one();
        
        if($jenis_cuti=="0"){
            if($updkar->saldo_cuti_lalu < $jml_hari ){}else{
                //pengurangan cuti
                $updkar->saldo_cuti_lalu = $updkar->saldo_cuti_lalu - $jml_hari;
                $updkar->save(false);
                //save cuti
                for($i = $begin; $i <= $end; $i->modify('+1 day')){
                    $tgl = $i->format("Y-m-d");
                    $model = new TransCuti();
                    $model->id_karyawan = $post['id_karyawan'];
                    $model->periode = $post['periode'];
                    $model->keterangan = $post['keterangan'];
                    $model->saldo_cuti = $post['saldo_cuti'];
                    $model->saldo_cuti_lalu = $post['saldo_cuti_lalu'];
                    $model->tgl_awal = $tgl;
                    $model->tgl_akhir = $tgl;
                    $model->jenis_cuti = $post['jenis_cuti'];
                    $model->jml_hari = $jml_hari;
                    $model->save(false);
                }
            }
        }else if($jenis_cuti=="1"){
            if($updkar->saldo_cuti < $jml_hari ){}else{
                //pengurangan cuti
                $updkar->saldo_cuti = $updkar->saldo_cuti - $jml_hari;
                $updkar->save(false); 
                //save cuti
                for($i = $begin; $i <= $end; $i->modify('+1 day')){
                    $tgl = $i->format("Y-m-d");
                    $model = new TransCuti();
                    $model->id_karyawan = $post['id_karyawan'];
                    $model->periode = $post['periode'];
                    $model->keterangan = $post['keterangan'];
                    $model->saldo_cuti = $post['saldo_cuti'];
                    $model->saldo_cuti_lalu = $post['saldo_cuti_lalu'];
                    $model->tgl_awal = $tgl;
                    $model->tgl_akhir = $tgl;
                    $model->jenis_cuti = $post['jenis_cuti'];
                    $model->jml_hari = $jml_hari+1;
                    $model->save(false);
                }
            }
        }
        return $this->redirect(['index']);
           
    }    

    /**
     * Updates an existing TransCuti model.
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

    public function actionUpdatecuti($id)
    {
        $model = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();

        if ($model->load(Yii::$app->request->post())) {
            //var_dump(Yii::$app->request->post());
            $model->save(false);
            return $this->redirect(['saldocuti']);
        }

        return $this->renderAjax('update_cuti', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing TransCuti model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $id_karyawan = $model->id_karyawan;
        $updkar = MasterKaryawan::find()
        ->where(['id_karyawan' => $id_karyawan])
        ->one();
        $jenis_cuti = $model->jenis_cuti;
        if($jenis_cuti=="0"){
            //penambahan cuti
            $updkar->saldo_cuti_lalu = $updkar->saldo_cuti_lalu + 1;
            $updkar->save(false);
        }else{
            //penambahan cuti
            $updkar->saldo_cuti = $updkar->saldo_cuti + 1 ;
            $updkar->save(false); 
        }

        //delete
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TransCuti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransCuti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransCuti::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
