<?php

namespace app\controllers\hrd;

use Yii;
use app\models\hrd\TransBank;
use app\models\hrd\TransBankSearch;
use app\models\hrd\MasterKaryawan;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper; 


/**
 * TransbankController implements the CRUD actions for TransBank model.
 */
class TransbankController extends Controller
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
     * Lists all TransBank models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = MasterKaryawan::find()
                ->orderBy(['id_karyawan' => SORT_DESC])
                ->where(['aktif' => 1])
                ->all();   

        return $this->render('index', [
            'model' => $model 
        ]);
    }

    /**
     * Displays a single TransBank model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();
        return $this->renderAjax('view', [
            'model' => $model
        ]);
    } 

    public function actionLog($id)
    {
        $model = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();
        $log = TransBank::find()
               ->where(['id_karyawan' => $id])
               ->orderBy(['id_transbank' => SORT_DESC])
               ->All();
        return $this->renderAjax('log', [
            'model' => $model,
            'log' => $log,
        ]);
    }

    /**
     * Creates a new TransBank model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransBank();
        $listkar = Yii::$app->helperdb->listKaryawan();
        $listbank = Yii::$app->helperdb->listBank();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'listkar' => $listkar,
            'listbank' => $listbank,
        ]);
    }

    /**
     * Updates an existing TransBank model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();
        $listbank = Yii::$app->helperdb->listBank();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //save log bank
            $TransBank = new TransBank();
            $TransBank->id_karyawan = $model->id_karyawan;
            $TransBank->id_bank = $model->id_bank;
            $TransBank->norek = $model->norek;
            $TransBank->atasnama = $model->atasnama;
            $TransBank->cabang = $model->cabangbank;
            $TransBank->kota = $model->kotabank;
            $TransBank->save(false);
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
            'listbank' => $listbank, 
        ]);
    }

    /**
     * Deletes an existing TransBank model.
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
     * Finds the TransBank model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransBank the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransBank::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
