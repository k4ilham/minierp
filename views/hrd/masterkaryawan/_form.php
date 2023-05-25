<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterKaryawan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-karyawan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_karyawan')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($model, 'id_departemen')->widget(Select2::classname(), [
            'data' => $listDepartemen,
            'options' => ['placeholder' => 'Pilih Departemen'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Departemen');
    ?>

    <?php
        echo $form->field($model, 'id_jabatan')->widget(Select2::classname(), [
            'data' => $listJabatan,
            'options' => ['placeholder' => 'Pilih Jabatan'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Jabatan');
    ?>

    <?php
        echo $form->field($model, 'id_lokasi')->widget(Select2::classname(), [
            'data' => $listLokasi,
            'options' => ['placeholder' => 'Pilih Lokasi'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Lokasi Kerja');
    ?>

    <?php
        echo $form->field($model, 'id_status')->widget(Select2::classname(), [
            'data' => $listStatus,
            'options' => ['placeholder' => 'Pilih Status Karyawan'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Status Karyawan');
    ?>

    <?= $form->field($model, 'aktif')->radioList(array(1=>'Aktif',0=>'Non Aktif')); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
