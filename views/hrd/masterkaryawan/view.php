<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterKaryawan */

$this->title = $model->id_karyawan;
$this->params['breadcrumbs'][] = ['label' => 'Master Karyawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$js = <<<js
	$('#mytable2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      "lengthMenu": [ [10, 25, 50, 100, 500, 100, -1],[10, 25, 50, 100, 500, 1000, "All"] ],
    })


js;
$this->registerJs($js);

?>


<ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Informasi 1</a></li>
    <li><a href="#tab2" data-toggle="tab">Informasi 2</a></li>
    <li><a href="#tab3" data-toggle="tab">Informasi 3</a></li>
    <li><a href="#tab4" data-toggle="tab">Informasi 4</a></li>
</ul>
<div class="tab-content no-padding">
    
    <!-- tab 1 -->
    <div class="tab-pane active" id="tab1" style="position: relative;">
        <table class='table table-striped table-hover table-bordered' id='mytable2'>
            <thead>
            </thead>
            <tbody>
            <tr><td width="30%">NIK</td><td width="1%">:</td><td><?=$model->nik?></td></tr>
            <tr><td>Nama Karyawan</td><td>:</td><td><?=$model->nama_karyawan?></td></tr>
            <tr><td>Departemen</td><td>:</td><td><?=Yii::$app->helperdb->getNamaDepartemen($model->id_departemen)?></td></tr>
            <tr><td>Jabatan</td><td>:</td><td><?=Yii::$app->helperdb->getNamaJabatan($model->id_jabatan)?></td></tr>
            <tr><td>Lokasi Kerja</td><td>:</td><td><?=Yii::$app->helperdb->getNamaLokasi($model->id_lokasi)?></td></tr>
            <tr><td>Status Karyawan</td><td>:</td><td><?=Yii::$app->helperdb->getNamaStatus($model->id_status)?></td></tr>
            <tr><td>Tanggal Masuk</td><td>:</td><td><?=$model->tgl_masuk?></td></tr>
            <tr><td>Tanggal Karyawan Tetap</td><td>:</td><td><?=$model->tgl_tetap?></td></tr>
            <tr><td>Tanggal keluar</td><td>:</td><td><?=$model->tgl_keluar?></td></tr>
            </tbody>
        </table>
        <hr>  
    </div>

    <!-- tab 2 -->
    <div class="tab-pane" id="tab2" style="position: relative;">
        <table class='table table-striped table-hover table-bordered' id='mytable2'>
            <thead>
            </thead>
            <tbody>
            <tr><td width="30%">Tempat/Tgl Lahir</td><td width="1%">:</td><td><?=$model->tempat_lahir?>,<?=$model->tgl_lahir?></td></tr>
            <tr><td>Agama</td><td>:</td><td><?=$model->agama?></td></tr>
            <tr><td>Pendidikan Terakhir</td><td>:</td><td><?=$model->pendidikan?></td></tr>
            <tr><td>Jenis Kelamin</td><td>:</td><td><?=Yii::$app->fungsi->namaJk($model->jk)?></td></tr>
            <tr><td>Golongan Darah</td><td>:</td><td><?=$model->goldarah?></td></tr>
            <tr><td>Status Menikah</td><td>:</td><td><?=Yii::$app->fungsi->namaStatusMenikah($model->menikah)?></td></tr>
            <tr><td>Jumlah Anak</td><td>:</td><td><?=$model->jml_anak?></td></tr>
            <tr><td>Jumlah Tanggungan</td><td>:</td><td><?=$model->jml_tanggungan?></td></tr>
            <tr><td>Nama Ibu Kandung</td><td>:</td><td><?=$model->ibu_kandung?></td></tr>
            </tbody>
        </table>
        <hr>
    </div>

    <!-- tab 3 -->
    <div class="tab-pane" id="tab3" style="position: relative;">
        <table class='table table-striped table-hover table-bordered' id='mytable2'>
            <thead>
            </thead>
            <tbody>
            <tr><td width="30%">No. KTP</td><td width="1%">:</td><td><?=$model->ktp?></td></tr>
            <tr><td>Alamat sesuai KTP</td><td>:</td><td><?=$model->alamat_ktp?></td></tr>
            <tr><td>Kota sesuai KTP</td><td>:</td><td><?=$model->kota?></td></tr>
            <tr><td>Alamat Tinggal</td><td>:</td><td><?=$model->alamat_tinggal?></td></tr>
            <tr><td>No. KK</td><td>:</td><td><?=$model->kk?></td></tr>
            <tr><td>No. NPWP</td><td>:</td><td><?=$model->npwp?></td></tr>
            <tr><td>NO. BPJS TK</td><td>:</td><td><?=$model->bpjstk?></td></tr>
            <tr><td>No. BPJS Kes</td><td>:</td><td><?=$model->bpjskes?></td></tr>
            </tbody>
        </table>
        <hr>
    </div>

    <!-- tab 4 -->
    <div class="tab-pane" id="tab4" style="position: relative;">
         <table class='table table-striped table-hover table-bordered' id='mytable2'>
            <thead>
            </thead>
            <tbody>
            <tr><td width="30%">No. HP 1</td><td width="1%">:</td><td><?=$model->nohp1?></td></tr>
            <tr><td>No. HP 2</td><td>:</td><td><?=$model->nohp2?></td></tr>
            <tr><td>Email</td><td>:</td><td><?=$model->email?></td></tr>
            <tr><td>Telegram</td><td>:</td><td><?=$model->telegram?></td></tr>
            <tr><td>Nama Bank</td><td>:</td><td><?=Yii::$app->helperdb->getNamaBank($model->id_bank)?></td></tr>
            <tr><td>No. Rekening</td><td>:</td><td><?=$model->norek?></td></tr>
            <tr><td>Atas Nama</td><td>:</td><td><?=$model->atasnama?></td></tr>
            <tr><td>Cabang Bank</td><td>:</td><td><?=$model->cabangbank?></td></tr>
            <tr><td>Kota Bank</td><td>:</td><td><?=$model->kotabank?></td></tr>
            </tbody>
        </table>
        <hr>
    </div>

    <p><?= Html::a('Update', ['update', 'id' => $model->id_karyawan], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $model->id_karyawan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        </p>
</div>






