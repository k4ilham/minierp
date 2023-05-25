<?php

namespace app\controllers;

use Yii;
use app\models\TransUser;
use app\models\TransUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransuserController implements the CRUD actions for TransUser model.
 */
class TransuserController extends Controller
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
     * Lists all TransUser models.
     * @return mixed
     */


    public function actionIndex()
    {
        $model = TransUser::find()
        ->orderBy(['id' => SORT_DESC])
        ->all();  
        
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionProfile()
    {
        $id=Yii::$app->user->id;
        $model = TransUser::find()
        ->where("id='$id'")
        ->one(); 
        
        if (\Yii::$app->request->post()) {
            $model->photo = \yii\web\UploadedFile::getInstance($model, 'photo');
            
            //if($model->validate()){
                $saveTo = 'file/uploads/user/' . $model->photo->baseName . '.' . $model->photo->extension;
                var_dump($saveTo);
                if($model->photo->saveAs($saveTo)){
                    $model->save(false);

                    //log
                    $json = json_encode($model->getAttributes());
                    Yii::$app->helperdb->saveLog($json);

                    Yii::$app->session->setFlash('success','Foto berhasil diupload');
                }
            //}
        } 
        
        return $this->render('profile', [
            'model' => $model,
        ]);
    } 

    public function actionGantipass()
    {
        $id=Yii::$app->user->id;
        $model = TransUser::find()
        ->where("id='$id'")
        ->one(); 
        
        if (\Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $passbaru = $post['passbaru'];
            $passlama = $post['passlama'];
            $passlama2 = $model->password_hash;
            if(!Yii::$app->security->validatePassword($passlama, $passlama2)){
                return $this->redirect(['gantipass']);
            }else{
                $ubahpass = TransUser::find()
                ->where("id='$id'")
                ->one();
                $passbaruhash = Yii::$app->security->generatePasswordHash($passbaru);
                $ubahpass->password_hash = $passbaruhash; 
                $ubahpass->save(false);

                //log
                $json = json_encode($ubahpass->getAttributes());
                Yii::$app->helperdb->saveLog($json);


                Yii::$app->user->logout();
                return $this->redirect(['site/index']);
                //var_dump("sama");
            }
        }else{
            return $this->render('gantipass', [
                'model' => $model,
            ]);
        }
        

    } 

    public function actionResetpass($id)
    {
        $ubahpass = TransUser::find()
        ->where("id='$id'")
        ->one();
        if($ubahpass){
            $passbaruhash = Yii::$app->security->generatePasswordHash("IJMS1234");
            $ubahpass->password_hash = $passbaruhash; 
            $ubahpass->save(false);

            //log
            $json = json_encode($ubahpass->getAttributes());
            Yii::$app->helperdb->saveLog($json);

        }
        return $this->redirect(['index']);
    } 



    /**
     * Displays a single TransUser model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        //log
        $json = json_encode($this->findModel($id)->getAttributes());
        Yii::$app->helperdb->saveLog($json);

        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TransUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransUser();

        if ($model->load(Yii::$app->request->post())) {
            $model->auth_key = Yii::$app->security->generateRandomString(); 
            $model->password_hash = Yii::$app->security->generatePasswordHash("IJMS1234");
            $model->status = 10; 
            $model->save(false);

            //log
            $json = json_encode($model->getAttributes());
            Yii::$app->helperdb->saveLog($json);

            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TransUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save(false);

            //log
            $json = json_encode($model->getAttributes());
            Yii::$app->helperdb->saveLog($json);

            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TransUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //log
        $json = json_encode($this->findModel($id)->getAttributes());
        Yii::$app->helperdb->saveLog($json);

        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the TransUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
