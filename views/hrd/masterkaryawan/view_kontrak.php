<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransGajiPokok */

$this->title = $model->id_karyawan;
$this->params['breadcrumbs'][] = ['label' => 'Bank', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trans-gaji-pokok-view">

<table class='table table-striped table-hover table-bordered' id='mytable2'>
    <thead>
    </thead>
    <tbody>
        <tr><td width="30%">NIK</td><td width="1%">:</td><td><?=$model->nik?></td></tr>
        <tr><td>Nama Karyawan</td><td>:</td><td><?=Yii::$app->helperdb->getNamaKaryawan($model->id_karyawan)?></td></tr>
        <tr><td>Periode Kontrak</td><td>:</td><td><?=$model->periode_kontrak?></td></tr>
        <tr><td>Lama Kontrak</td><td>:</td><td><?=$model->bulan_kontrak?></td></tr>
        <tr><td>Mulai Kontrak</td><td>:</td><td><?=$model->mulai_kontrak?></td></tr>
        <tr><td>Akhir Kontrak</td><td>:</td><td><?=$model->akhir_kontrak?></td></tr>
    </tbody>
</table>
<hr>
    <p>
        <?= Html::a('Update', ['updatekontrak', 'id' => $model->id_karyawan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Log', ['logkontrak', 'id' => $model->id_karyawan], ['class' => 'btn btn-danger']) ?>
    </p>
</div>
