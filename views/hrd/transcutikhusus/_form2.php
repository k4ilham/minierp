<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\TimePicker;
use yii\jui\DatePicker;
use yii\helpers\Url;


$url = Url::base(true);
?> 

<div class="trans-cuti-form">

    <form id="transcuti" action="<?=Url::base(true);?>/transcutikhusus/update2" method="POST">
    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
    

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
            'name' => 'tgl_awal',
            'attribute' => 'tgl_awal',
            'dateFormat' =>'yyyy-MM-dd',
            'options'=>['class'=>'form-control'],
            ]);
    ?>

    <br><b>Tanggal Selesai</b>
    <?php
        echo DatePicker::widget([
            'name' => 'tgl_akhir',
            'attribute' => 'tgl_akhir',
            'dateFormat' =>'yyyy-MM-dd',
            'options'=>['class'=>'form-control'],
            ]);
    ?>

    <br><b>Nama Karyawan</b>
    <?php
        echo Select2::widget([
            'name' => 'id_karyawan',
            'data' => $listkar,
            'options' => ['placeholder' => 'Karyawan','id' => 'mykar'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <br><b>Jenis Cuti</b>
    <?php
        echo Select2::widget([
            'name' => 'jenis_cuti',
            'data' => $listmastercutikhusus,
            'options' => ['placeholder' => 'Nama Cuti','id' => 'myjeniscuti'],
            'pluginOptions' => [
                'allowClear' => true
            ],
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
