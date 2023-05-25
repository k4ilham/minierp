<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Employee;
use app\models\hrd\MasterDepartemen;
use app\models\hrd\MasterStatus;

class SiteController extends Controller
{
    /** 
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $departemen = MasterDepartemen::find()
            ->orderBy(['id_departemen' => SORT_DESC])
            ->all();

            $liststatus = MasterStatus::find()
            ->orderBy(['id_status' => SORT_ASC])
            ->all();
            

            return $this->render('index',[
                'departemen' => $departemen,
                'liststatus' => $liststatus,
            ]);
        }else{
            return $this->redirect(['login']);
        }        
        
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'main-login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            //log
            $json = json_encode($model->getAttributes());
            Yii::$app->helperdb->saveLog($json);

            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        // Log
        $user = Yii::$app->user->identity;
        $json = $user ? json_encode($user->attributes) : '';
        Yii::$app->helperdb->saveLog($json);
    
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionHello($nama="")
    {
        //return "Hello Word!";
        return "Hello ".$nama;
    }

    public function actionTampil($nama="")
    {
        return $this->render('hello',[
            'nama' => $nama,
        ]);
    }

    public function actionUrl()
    {
        return $this->render('url');
    }

    public function actionKomentar()
    {
        $model = new \app\models\Komentar();
        
        // Jika form di-submit dengan method POST
        if(Yii::$app->request->post()){
            $model->load(Yii::$app->request->post());
            if($model->validate()){
                Yii::$app->session->setFlash('success','Terima kasih ');       
            }
            else{
                Yii::$app->session->setFlash('error','Maaf, salah!');   
            }
            return $this->render('hasil_komentar', [
                'model' => $model,
            ]); 
        }
        else{
            return $this->render('komentar', [
                'model' => $model,
            ]); 
        }       
    }

    public function actionQuery()
    {
        $db = Yii::$app->db;
        $command = $db->createCommand('SELECT * FROM employee');
        $employees = $command->queryAll();
        //Ekstrak data
        foreach($employees as $employee){
            echo "<br>";
            echo $employee['id']." ";
            echo $employee['name']." ";
            echo "(".$employee['age'].") ";            
        }
    }

    public function actionQuery2()
    {
        $db = Yii::$app->db;
        // return a single row 
        //$employee = $db->createCommand('SELECT * FROM employee WHERE id=1')->queryOne();
        // Binding Parameter
        $employee = $db->createCommand('SELECT * FROM employee WHERE id=:id',['id'=> 2])->queryOne();
        echo $employee['id']." ";
        echo $employee['name']." ";
        echo "(".$employee['age'].") ";    
        echo "<hr>";
        // return a single column (the first column)
        $names = $db->createCommand('SELECT name FROM employee')
                                 ->queryColumn();
        print_r($names);
        echo "<hr>";
        // return a scalar
        $count = $db->createCommand('SELECT COUNT(*) FROM employee')
                               ->queryScalar();
        echo "Jumlah employee ".$count;
        echo "<hr>";

        //row affected
        $row_affected = $db->createCommand('UPDATE employee SET age=30 WHERE id=1')->execute();
        echo $row_affected.' row affected';

        // INSERT (table name, column values)
        $db->createCommand()->insert('employee', [
            'name' => 'Hasan',
            'age' => 30,
        ])->execute();

        // UPDATE (table name, column values, condition)
        $db->createCommand()->update('employee', ['age' => 30], 'id = 1')
        ->execute();

        // DELETE (table name, condition)
        $db->createCommand()->delete('employee', 'age >30')
        ->execute();   

        // table name, column names, column values
        $db->createCommand()->batchInsert('employee', 
            ['name', 'age'], 
            [
                ['Farhan', 30],
                ['Jane', 20],
                ['Linda', 25],
            ])->execute();
    }

    public function actionActiveRecord()
    {
        $employees = \app\models\Employee::find()->all();
        foreach($employees as $employee){
            echo "<br>";
            echo $employee->id." ";
            echo $employee->name." ";
            echo "(".$employee->age.") ";            
        }

        // SELECT * FROM `employee` WHERE `id` = 2
        // $employee = Employee::find()
        //     ->where(['id' => 2])
        //     ->one();
        // echo $employee->name;

        // return semua employee yang usianya > 25 dan sortir berdasarkan ID
        // SELECT * FROM `employee` WHERE `age` > 25 ORDER BY `id`
        // $employees = Employee::find()
        //     ->where(['>','age',25])
        //     ->orderBy('id')
        //     ->all();
        // print_r($employees);

        // // SELECT COUNT(*) FROM `employee`
        // $count = Employee::find()
        //     ->count();
        // echo $count;

        // // SELECT * FROM `employee` WHERE `id` = 2
        // $employee = Employee::findOne(2);

        // // SELECT * FROM `employee` WHERE `id` IN (1,2,3)
        // $employees = Employee::findAll([1,2,3]);

        // // SELECT * FROM `employee` WHERE `age` = 30 LIMIT 1
        // $employee = Employee::findOne([
        //     'age' => 30
        // ]);

        // // SELECT * FROM `employee` WHERE `age` = 30
        // $employee = Employee::findOne([
        //     'age' => 30
        // ]);

        // // insert a new row of data
        // // INSERT INTO employee(name,age) VALUES('James',34)
        // $employee = new Employee();
        // $employee->name = 'James';
        // $employee->age = 34;
        // $employee->save();

        // // update an existing row of data
        // // UPDATE employee SET name='James Gordon' WHERE id = 5
        // $employee = Employee::findOne(5);
        // $employee->name = 'James Gordon';
        // $employee->save();

        // // delete
        // // DELETE FROM employee WHERE id=5
        // $employee = Employee::findOne(5);
        // $employee->delete();

    }

    public function actionSignup()
    {
        $model = new \app\models\SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
    
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionUpload()
    {
        $user_id = \Yii::$app->user->id;
        $model = \app\models\UserPhoto::find()->where([
            'user_id' => $user_id
        ])->one();
    
        if(!$model){
            $model = new \app\models\UserPhoto([
                'user_id' => $user_id
            ]);
        }
    
        if (\Yii::$app->request->post()) {
            $model->photo = \yii\web\UploadedFile::getInstance($model, 'photo');
            if($model->validate()){
                $saveTo = 'uploads/' . $model->photo->baseName . '.' . $model->photo->extension;
                if($model->photo->saveAs($saveTo)){
                    $model->save(false);
                    Yii::$app->session->setFlash('success','Foto berhasil diupload');
                }
            }
        }
    
        return $this->render('upload', [
            'model' => $model
        ]);
    }  
    
   
    public function actionGallery()
    {
        $model = new \app\models\Galery();
        if (\Yii::$app->request->post()) {
            $model->image = \yii\web\UploadedFile::getInstances($model, 'image');
            if ($model->validate()) {
                foreach ($model->image as $file) {
                    $saveTo = 'uploads/' . $file->baseName . '.' . $file->extension;
                    if ($file->saveAs($saveTo)) {
                        $model2 = new \app\models\Galery([
                            'image' => $file->baseName . '.' . $file->extension,
                        ]);
                        $model2->save(false);
                    }
                }
                \Yii::$app->session->setFlash('success', 'Image berhasil di upload');
            }
        }
    
        return $this->render('gallery', [
            'model' => $model
        ]);
    }
    

}
