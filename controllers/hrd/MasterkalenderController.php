<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\MasterKalender;
use app\models\hrd\MasterKalenderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MasterkalenderController implements the CRUD actions for MasterKalender model.
 */
class MasterkalenderController extends Controller
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
     * Lists all MasterKalender models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
        isset($_GET['bulan']) ?  $bulan = $_GET['bulan'] : $bulan = date('m');

        $list_tahun = Yii::$app->db->createCommand('SELECT YEAR(tgl) AS thn 
                        FROM master_kalender
                        where YEAR(tgl) < 2026
                        GROUP BY YEAR(tgl)')
                     ->queryAll();

        $list_bulan = Yii::$app->db->createCommand('SELECT MONTH(tgl) AS bln 
                        FROM master_kalender
                        GROUP BY MONTH(tgl)')
                    ->queryAll();

        $model = MasterKalender::find()
                ->where("year(tgl)='$tahun' AND  month(tgl)='$bulan'")
                ->orderBy(['id_kalender' => SORT_DESC])
                ->all(); 

        return $this->render('index', [
            'model' => $model,
            'list_tahun' => $list_tahun,
            'list_bulan' => $list_bulan,
        ]);
    }

    /**
     * Displays a single MasterKalender model.
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
     * Creates a new MasterKalender model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MasterKalender();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MasterKalender model.
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

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MasterKalender model.
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
     * Finds the MasterKalender model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MasterKalender the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MasterKalender::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
