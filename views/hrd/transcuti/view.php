<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransLembur */

$this->title = "Cuti";
$this->params['breadcrumbs'][] = ['label' => 'Trans Lemburs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$periodeaktif = Yii::$app->helperdb->periodeAktif();

?>
<div class="trans-lembur-view">


<table class='table table-striped table-hover table-bordered' id='mytable2'>
    <thead>
    </thead>
    <tbody>
        <tr><td width="30%">Periode</td><td width="1%">:</td><td><?=$model->periode?></td></tr>
        <tr><td>Nama Karyawan</td><td>:</td><td><?=Yii::$app->helperdb->getNamaKaryawan($model->id_karyawan)?></td></tr>
        <tr><td>Jenis Cuti</td><td>:</td><td><?=$model->jenis_cuti?></td></tr>
        <tr><td>Tgl Awal</td><td>:</td><td><?=$model->tgl_awal?></td></tr>
        <tr><td>Tgl Akhir</td><td>:</td><td><?=$model->tgl_akhir?></td></tr>
        <tr><td>Jumlah hari</td><td>:</td><td><?=$model->jml_hari?></td></tr>
    </tbody>
</table>
<hr>

<?php if($periodeaktif == $model->periode){ ?>
    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_cuti], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php } ?>

</div>
