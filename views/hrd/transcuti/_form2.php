<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\TimePicker;
use yii\jui\DatePicker;
use yii\helpers\Url;


$url = Url::base(true);
$js = <<<js
	$('#mykar').change(function(){ 
      var value2 = $('#mykar').val();
      //alert(value2);
      myurl = '$url/transcuti/api-saldocuti?id='+value2;
	  $.post( myurl, function( data ) {
         $('#saldo_cuti').val(data.saldo_cuti);
         $('#saldo_cuti_lalu').val(data.saldo_cuti_lalu);
	  });
    });
js;
$this->registerJs($js);
?> 

<div class="trans-cuti-form">

    <form id="transcuti" action="<?=Url::base(true);?>/transcuti/update2" method="POST">
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

    <br><b>Saldo Cuti Tahun Ini</b>
    <input type="text"  name="saldo_cuti" id="saldo_cuti" class="form-control"  width="400px" readonly>
    <br><b>Saldo Cuti Tahun Lalu</b>
    <input type="text"  name="saldo_cuti_lalu" id="saldo_cuti_lalu" class="form-control"  width="400px" readonly>
    
    <br><b>Cuti yang diambil</b>
    <select name="jenis_cuti" class="form-control">
        <option value="0">Tahun Lalu</a>
        <option value="1">Tahun Ini</a>
    </select>

    <br><b>Keterangan</b>
    <input type="text"  name="keterangan" class="form-control"  width="400px">

    <br>
    <div class="form-group">
       <input type="submit"  value="Save" class="btn btn-primary">
    </div>

    </form>

</div>
