<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransLembur */

$this->title = $model->id_lembur;
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
        <tr><td>Tgl Lembur</td><td>:</td><td><?=$model->tgl_lembur?></td></tr>
        <tr><td>Jenis Hari</td><td>:</td><td><?=$model->jh?></td></tr>
    </tbody>
</table>
<hr>

<?php if($periodeaktif == $model->periode){ ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_lembur], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_lembur], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php } ?>

</div>
