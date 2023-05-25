<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\TimePicker;
use yii\jui\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransSakit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-sakit-form">

    <form action="<?=Url::base(true);?>/transoff/update2" method="POST">
    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
    
    <br><b>Nama Karyawan</b>
    <?php
        echo Select2::widget([
            'name' => 'id_karyawan',
            'data' => $listkar,
            'options' => ['placeholder' => 'Karyawan'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <br><b>Periode</b>
    <?php
        echo Select2::widget([
            'name' => 'periode',
            'data' => $listperiode,
            'options' => ['placeholder' => 'periode'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <br><b>Tanggal Mulai</b>
    <?php
        echo DatePicker::widget([
            'name' => 'tgl_mulai',
            'attribute' => 'tgl_mulai',
            'dateFormat' =>'yyyy-MM-dd',
            'options'=>['class'=>'form-control'],
            ]);
    ?>

    <br><b>Tanggal Selesai</b>
    <?php
        echo DatePicker::widget([
            'name' => 'tgl_selesai',
            'attribute' => 'tgl_selesai',
            'dateFormat' =>'yyyy-MM-dd',
            'options'=>['class'=>'form-control'],
            ]);
    ?>

    <br><b>Keterangan</b>
    <input type="text"  name="keterangan" class="form-control"  width="400px">

    <br>
    <div class="form-group">
       <input type="submit"  value="Save" class="btn btn-primary">
    </div>

    </form>

</div>
