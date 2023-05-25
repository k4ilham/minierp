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

            <?php
                echo $form->field($model, 'id_bank')->widget(Select2::classname(), [
                    'data' => $listbank,
                    'options' => ['placeholder' => 'Pilih Bank'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label('Nama Bank');
            ?>
            <?= $form->field($model, 'norek')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'atasnama')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'cabangbank')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'kotabank')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
    </div>




</div>



