<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterKaryawan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-12 col-xs-12">

            <?php $form = ActiveForm::begin(); ?>


            <table class='table table-striped table-hover table-bordered' id='mytable2'>
                <thead>
                </thead>
                <tbody>
                    <tr><td width="30%">NIK</td><td width="1%">:</td><td><?=$model->nik?></td></tr>
                    <tr><td>Nama Karyawan</td><td>:</td><td><?=Yii::$app->helperdb->getNamaKaryawan($model->id_karyawan)?></td></tr>
                </tbody>
            </table>
            <hr>

            <?= $form->field($model, 'periode_kontrak')->radioList(array(1=>"Pertama",2=>"Kedua", 3=>"Ketiga",4=>"Keempat")); ?>
            <?= $form->field($model, 'bulan_kontrak')->radioList(array(3=>"3 Bulan",6=>"6 Bulan", 12=>"12 Bulan")); ?>

            <?php
                echo $form->field($model, 'mulai_kontrak')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Mulai Kontrak'],
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);
            ?>

            <?php
                echo $form->field($model, 'akhir_kontrak')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Akhir Kontrak'],
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);
            ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
    </div>




</div>



