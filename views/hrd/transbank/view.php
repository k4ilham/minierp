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
        <tr><td>Bank</td><td>:</td><td><?=Yii::$app->helperdb->getNamaBank($model->id_bank)?></td></tr>
        <tr><td>No Rekening</td><td>:</td><td><?=$model->norek?></td></tr>
        <tr><td>Atas Nama</td><td>:</td><td><?=$model->atasnama?></td></tr>
        <tr><td>Cabang</td><td>:</td><td><?=$model->cabangbank?></td></tr>
        <tr><td>Kota</td><td>:</td><td><?=$model->kotabank?></td></tr>
    </tbody>
</table>
<hr>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_karyawan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Log', ['log', 'id' => $model->id_karyawan], ['class' => 'btn btn-danger']) ?>
    </p>

</div>
