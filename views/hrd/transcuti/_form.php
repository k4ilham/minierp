<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\widgets\TimePicker;
use yii\helpers\Url;

$url = Url::base(true);
$js = <<<js
	$('#mykar').change(function(){ 
      var value2 = $('#mykar').val();
      //alert(value2);
      myurl = '$url/transcuti/api-saldocuti?id='+value2;
	  $.post( myurl, function( data ) {
         $('#transcuti-saldo_cuti').val(data.saldo_cuti);
         $('#transcuti-saldo_cuti_lalu').val(data.saldo_cuti_lalu);
	  });
    });
js;
$this->registerJs($js);
?> 



<div class="trans-lembur-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?php
        echo $form->field($model, 'id_karyawan')->widget(Select2::classname(), [
            'data' => $listkar,
            'name'=> 'id_karyawan',
            'options' => ['placeholder' => 'Pilih Karyawan','id' => 'mykar' ,],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Nama Karyawan');
    ?>

    

    <?= $form->field($model, 'saldo_cuti_lalu')->textInput(['readOnly'=>true])->label('Saldo Cuti Tahun Lalu') ?>
    <?= $form->field($model, 'saldo_cuti')->textInput(['readOnly'=>true])->label('Saldo Cuti Tahun Ini') ?>

    <?= $form->field($model, 'jenis_cuti')->radioList(array('TAHUN1'=>'TAHUN LALU','TAHUN2'=>'TAHUN INI','KHUSUS'=>'KHUSUS')); ?>
    
    

    <?php
        echo $form->field($model, 'periode')->widget(Select2::classname(), [
            
            'data' => $listperiode,
            'options' => ['placeholder' => 'Pilih Periode'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?php
        echo $form->field($model, 'tgl_awal')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Tanggal Awal Cuti'],
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
    ?>

    <?php
        echo $form->field($model, 'tgl_akhir')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Tanggal Akhir Cuti'],
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
    ?>

    <?= $form->field($model, 'jml_hari')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
