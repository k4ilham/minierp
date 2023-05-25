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
            Informasi 1
            <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
            </div>
            </div>
            <div class="box-body">

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
                echo $form->field($model, 'id_group')->widget(Select2::classname(), [
                    'data' => $listGroup,
                    'options' => ['placeholder' => 'Pilih Group'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label('Group');
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

            <?php
                echo $form->field($model, 'id_jam_kerja')->widget(Select2::classname(), [
                    'data' => $listJamKerja,
                    'options' => ['placeholder' => 'Pilih Jam Kerja'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label('Jam Kerja'); 
            ?>

<?php
                echo $form->field($model, 'tgl_masuk')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Tanggal Masuk'],
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);
            ?>

            <?php
                echo $form->field($model, 'tgl_tetap')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Tanggal Karyawan tetap'],
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);
            ?>

            <?php
                echo $form->field($model, 'tgl_keluar')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Tanggal Keluar'],
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);
            ?>

            

            </div>
        </div>

    </div>


    <div class="col-lg-3 col-xs-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
            Informasi 2
            <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
            </div>
            </div>
            <div class="box-body">


            <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

            <?php
                echo $form->field($model, 'tgl_lahir')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Tanggal Lahir'],
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);
            ?>

            <?= $form->field($model, 'agama')->radioList(array('ISLAM'=>'ISLAM','PROTESTAN'=>'PROTESTAN','KATOLIK'=>'KATOLIK','HINDU'=>'HINDU','BUDHA'=>'BUDHA','KHONGHUCU'=>'KHONGHUCU')); ?>

            <?= $form->field($model, 'pendidikan')->radioList(array('SD'=>'SD','SMP'=>'SMP','SMA'=>'SMA','D1'=>'D1','D3'=>'D3','S1'=>'S1','S2'=>'S2','S3'=>'S3')); ?>

            <?= $form->field($model, 'jk')->radioList(array(1=>'Laki-Laki',0=>'Perempuan')); ?>

            <?= $form->field($model, 'goldarah')->radioList(array('A'=>'A','B'=>'B','AB'=>'AB','O'=>'O')); ?>

            <?= $form->field($model, 'menikah')->radioList(array(1=>'Menikah',0=>'Lajang')); ?>
            

            <?= $form->field($model, 'jml_anak')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'jml_tanggungan')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'ibu_kandung')->textInput(['maxlength' => true]) ?>
            



           

            </div>
        </div>

    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
            Informasi 3
            <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
            </div>
            </div>
            <div class="box-body">


            <?= $form->field($model, 'ktp')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'alamat_ktp')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'kota')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'alamat_tinggal')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'kk')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'npwp')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'bpjstk')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'bpjskes')->textInput(['maxlength' => true]) ?>




            </div>
        </div>

    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
            Informasi 4
            <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
            </div>
            </div>
            <div class="box-body">

            <?= $form->field($model, 'nohp1')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'nohp2')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'saldo_cuti')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'saldo_cuti_lalu')->textInput(['maxlength' => true])->label('Saldo Cuti Tahun Lalu') ?>

            <?= $form->field($model, 'aktif')->radioList(array(1=>'Aktif',0=>'Non Aktif')); ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Back', ['index'], ['class' => 'btn btn-danger']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            </div>
        </div>

    </div>

</div>



