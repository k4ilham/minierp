<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use aki\telegram\base\Command;


class TelegramController extends Controller
{

    
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


    public function actionIndex()
    {
       echo "Haloo";
    }

    public function actionSendmessage()
    {
        $chat_id = "267145721";
       Yii::$app->telegram->sendMessage([
        'chat_id' => $chat_id,
        'text' => 'test',
        ]); 
    }

    public function actionSendmessage2()
    {

    }

    public function actionSendmessageinline()
    {
        $chat_id = "267145721";
        Yii::$app->telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'this is test',
            'reply_markup' => json_encode([
                'inline_keyboard'=>[
                    [
                        ['text'=>"refresh",'callback_data'=> time()]
                    ]
                ]
            ]),
        ]);
    }

    public function actionSendphoto()
    {
        $chat_id = "267145721";
        Yii::$app->telegram->sendPhoto([
            'chat_id' => $chat_id,
            //'photo' => Yii::$app->getBaseUrl().'/uploads/test.jpg',
            'photo' => 'http://1.bp.blogspot.com/-Lf1dF7tLoh4/Vh9KiOqSaJI/AAAAAAAAAZc/msc4UpXyVTs/s400/PT.%2BIntan%2BJaya%2BMedika%2BSolusi.png',
            'caption' => 'this is test'
        ]);
    }

    public function actionSendemail()
    {
        $email = "mis.application@sinarrodautama.co.id";
        $subject = "Payroll IJMS";
        $body = "Slip Gaji 2021-06";
        Yii::$app->mailer->compose()
        ->setTo($email)
        ->setFrom('noreply@sinarrodautama.co.id')
        ->setSubject($subject)
        ->setHtmlBody($body) 
        ->send();
        echo "Email Sent";
    }

}
