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


    <div class="col-lg-3 col-xs-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
            Informasi Perusahaan
            <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
            </div>
            </div>
            <div class="box-body">

            <?php $form = ActiveForm::begin(); ?>


            <?= $form->field($model, 'perusahaan')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'akronim')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'umr')->textInput(['maxlength' => true])->label('Gaji UMR') ?>
            

            </div>
        </div>

    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
            Jaminan Pensiun
            <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
            </div>
            </div>
            <div class="box-body">

            

            <?= $form->field($model, 'umur_pensiun')->textInput(['maxlength' => true])->label('Umur Max') ?>
            <?= $form->field($model, 'max_pensiun')->textInput(['maxlength' => true])->label('Gaji Max') ?>
            <?= $form->field($model, 'persen_pensiun_kar')->textInput(['maxlength' => true])->label('% Karyawan') ?>
            <?= $form->field($model, 'persen_pensiun_per')->textInput(['maxlength' => true])->label('% Perusahaan') ?>
            <?= $form->field($model, 'persen_pensiun_total')->textInput(['maxlength' => true])->label('% Dibayarkan') ?>
            </div>


        </div>

    </div>


    <div class="col-lg-3 col-xs-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
            BPJS Kesehatan
            <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
            </div>
            </div>
            <div class="box-body">
            
    
            <?= $form->field($model, 'max_bpjskes')->textInput(['maxlength' => true])->label('Gaji Max') ?>
            <?= $form->field($model, 'persen_bpjskes_kar')->textInput(['maxlength' => true])->label('% Karyawan') ?>
            <?= $form->field($model, 'persen_bpjskes_per')->textInput(['maxlength' => true])->label('% Perusahaan') ?>
            <?= $form->field($model, 'persen_bpjskes_total')->textInput(['maxlength' => true])->label('% Dibayarkan') ?>




            </div>
        </div>

    </div>



    <div class="col-lg-3 col-xs-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
            BPJS Ketenagakerjaan
            <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
            </div>
            </div>
            <div class="box-body">
            
            <?= $form->field($model, 'persen_bpjstk_kar')->textInput(['maxlength' => true])->label('% Karyawan') ?>
            <?= $form->field($model, 'persen_bpjstk_per')->textInput(['maxlength' => true])->label('% Perusahaan') ?>
            <?= $form->field($model, 'persen_bpjstk_total')->textInput(['maxlength' => true])->label('% Dibayarkan') ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Back', ['index'], ['class' => 'btn btn-danger']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            </div>
        </div>

    </div>







</div>



