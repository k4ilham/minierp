<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransGajiPokok */

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

$this->title = $model->id_karyawan;
$this->params['breadcrumbs'][] = ['label' => 'Log Kontrak', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trans-gaji-pokok-view">

<table class='table table-striped table-hover table-bordered' id='mytable3'>
    <thead>
    </thead>
    <tbody>
        <tr><td width="30%">NIK</td><td width="1%">:</td><td><?=$model->nik?></td></tr>
        <tr><td>Nama Karyawan</td><td>:</td><td><?=Yii::$app->helperdb->getNamaKaryawan($model->id_karyawan)?></td></tr>
    </tbody>
</table>
<hr>

<table class='table table-striped table-hover table-bordered' id='mytable2'>
<thead>
    <tr>
    <th width="5%" align="center">No</th>
    <th align="center">Tanggal</th>
    <th align="center">Periode</th>
    <th align="center">Lama</th>
    <th align="center">Mulai</th>
    <th align="center">Akhir</th>
    </tr>
</thead>
<tbody>
<?php 
$no=1;
foreach($log as $row){ 
    ?>
    <tr>
        <td align="center"><?=$no?></td>
        <td><?=$row->created_at?></td> 
        <td><?=$row->periode_kontrak?></td>
        <td><?=$row->bulan_kontrak?></td>
        <td><?=$row->mulai_kontrak?></td>
        <td><?=$row->akhir_kontrak?></td> 
    </tr>
<?php $no++; } ?>
</tbody>
</table>


</div>
