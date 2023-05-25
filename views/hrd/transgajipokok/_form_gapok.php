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
                    <tr><td>Gaji UMR</td><td>:</td><td><?=number_format($umr)?></td></tr>
                    <tr><td>Gaji Pokok</td><td>:</td><td><?=number_format($model->gapok)?></td></tr>

                </tbody>
            </table>
            <hr>

            <?= $form->field($model, 'gapok')->textInput(['maxlength' => true]) ?>

            <b>Keterangan</b><br>
            <input class="form-control" type="text" name="keterangan"><br>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
    </div>




</div>



