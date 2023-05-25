<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\TransTunjanganKeahlian;
use app\models\hrd\TransTunjanganKeahlianSearch;
use app\models\hrd\MasterKaryawan;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TranstunjangankeahlianController implements the CRUD actions for TransTunjanganKeahlian model.
 */
class TranstunjangankeahlianController extends Controller
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
     * Lists all TransTunjanganKeahlian models.
     * @return mixed
     */
    public function actionIndex()
    {
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        isset($_GET['aktif']) ?  $aktif = $_GET['aktif'] : $aktif = 1;


        $model = TransTunjanganKeahlian::find()
                 ->where("aktif='$aktif'")
                ->orderBy(['id_tunjangan_keahlian' => SORT_DESC])
                ->all(); 

        return $this->render('index', [
            'model' => $model
        ]);
    }   

    /**
     * Displays a single TransTunjanganKeahlian model.
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
     * Creates a new TransTunjanganKeahlian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransTunjanganKeahlian();
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
     * Updates an existing TransTunjanganKeahlian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $listkar = Yii::$app->helperdb->listKaryawan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
            'listkar' => $listkar,
        ]);
    }

    /**
     * Deletes an existing TransTunjanganKeahlian model.
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
     * Finds the TransTunjanganKeahlian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransTunjanganKeahlian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransTunjanganKeahlian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
