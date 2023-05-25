<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransLembur */

$this->title = "Potongan";
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$periodeaktif = Yii::$app->helperdb->periodeAktif();

?>
<div class="trans-lembur-view">


<table class='table table-striped table-hover table-bordered' id='mytable2'>
    <thead>
    </thead>
    <tbody>
        <tr><td width="30%">Nama Karyawan</td><td width="1%">:</td><td><?=Yii::$app->helperdb->getNamaKaryawan($model->id_karyawan)?></td></tr>
        <tr><td>Nominal</td><td>:</td><td><?=number_format($model->nominal,0)?></td></tr>
        <tr><td>Keterangan</td><td>:</td><td><?=$model->keterangan?></td></tr>
    </tbody>
</table>
<hr>

<?php if($periodeaktif == $model->periode){ ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_potongan_kedisplinan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_potongan_kedisplinan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php } ?>

</div>
