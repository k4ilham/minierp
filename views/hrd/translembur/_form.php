<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\widgets\TimePicker

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransLembur */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-lembur-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php

        echo $form->field($model, 'id_karyawan')->widget(Select2::classname(), [
            'data' => $listkar,
            'options' => ['placeholder' => 'Pilih Karyawan'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Nama Karyawan');
    ?>

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
        echo $form->field($model, 'tgl_lembur')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Tanggal Lembur'],
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
    ?>

    <?=$form->field($model, 'jam_mulai')->widget(TimePicker::classname(), [
    'pluginOptions' => [
        'showSeconds' => false,
        'showMeridian' => false,
        'minuteStep' => 1,
        'secondStep' => 5,
    ]
    ]);?>

    <?=$form->field($model, 'jam_selesai')->widget(TimePicker::classname(), [
    'pluginOptions' => [
        'showSeconds' => false,
        'showMeridian' => false,
        'minuteStep' => 1,
        'secondStep' => 5,
    ]
    ]);?>


    <?= $form->field($model, 'jam_istirahat')->radioList(array(0=>'0 Jam',1=>'1 Jam',2=>'2 Jam',3=>'3 Jam',4=>'4 Jam')); ?>

    <?= $form->field($model, 'jh')->radioList(array('K'=>'KERJA','L'=>'LIBUR')); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
