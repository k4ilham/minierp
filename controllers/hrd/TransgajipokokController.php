<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\TransGajiPokok;
use app\models\hrd\TransGajiPokokSearch;
use app\models\hrd\MasterKaryawan;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;
use kartik\mpdf\Pdf;

/**
 * TransgajipokokController implements the CRUD actions for TransGajiPokok model.
 */
class TransgajipokokController extends Controller
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
     * Lists all TransGajiPokok models.
     * @return mixed
     */
    public function actionIndex()
    {
        $listDepartemen = Yii::$app->helperdb->listDepartemen();

        $model = MasterKaryawan::find()
        ->orderBy(['id_karyawan' => SORT_DESC])
        ->where(['aktif' => 1])
        ->all();  

        if (Yii::$app->request->post()){

            $post = Yii::$app->request->post();
            $id_departemen = $post['id_departemen'];

            if($id_departemen=="ALL"){
                $model = MasterKaryawan::find()
                ->where(['aktif' => 1])
                ->orderBy(['id_karyawan' => SORT_DESC])
                ->all();  
            }else{
                $model = MasterKaryawan::find()
                ->where(['aktif' => 1])
                ->andwhere(['id_departemen' => $id_departemen])
                ->orderBy(['id_karyawan' => SORT_DESC])
                ->all(); 
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
                            'options' => ['title' => 'Gaji Pokok'],
                            'methods' => [ 
                                'SetHeader'=>[''], 
                        ]
                    ]);
                    return $pdf->render(); 
            }
        }

   
 
        return $this->render('index', [
            'model' => $model,
            'listDepartemen' => $listDepartemen
        ]);  
    } 

    /**
     * Displays a single TransGajiPokok model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();
        return $this->renderAjax('view', [
            'model' => $model,
        ]);
    }

    public function actionLog($id)
    {
        $model = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();
        $log = TransGajiPokok::find()
               ->where(['id_karyawan' => $id])
               ->orderBy(['id_gaji_pokok' => SORT_DESC])
               ->All();
        return $this->renderAjax('log', [
            'model' => $model,
            'log' => $log,
        ]);
    }

    /**
     * Creates a new TransGajiPokok model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransGajiPokok();
        $listkar = Yii::$app->helperdb->listKaryawan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'listkar' => $listkar,
        ]);
    }
 
    /**
     * Updates an existing TransGajiPokok model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();
        $listDepartemen = Yii::$app->helperdb->listDepartemen();
        $listStatus = Yii::$app->helperdb->listStatus();
        $listJabatan = Yii::$app->helperdb->listJabatan();
        $listLokasi = Yii::$app->helperdb->listLokasi();
        $umr = Yii::$app->helperdb->getUmr();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //save log gaji pokok
            $TransGajiPokok = new TransGajiPokok();
            $TransGajiPokok->id_karyawan = $model->id_karyawan;
            $TransGajiPokok->tgl_gaji = date('Y-m-d');
            $TransGajiPokok->aktif = 1;
            $TransGajiPokok->nominal = $model->gapok;
            $TransGajiPokok->keterangan = Yii::$app->request->post('keterangan');
            $TransGajiPokok->save(false);
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
            'listDepartemen' => $listDepartemen,
            'listStatus' => $listStatus,
            'listJabatan' => $listJabatan,
            'listLokasi' => $listLokasi,
            'umr' => $umr,
        ]);
    }

    /**
     * Deletes an existing TransGajiPokok model.
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
     * Finds the TransGajiPokok model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransGajiPokok the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransGajiPokok::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
