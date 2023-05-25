<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransTunjanganMasaKerja */

$this->title = $model->id_tunjangan_masa_kerja;
$this->params['breadcrumbs'][] = ['label' => 'Trans Tunjangan Masa Kerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trans-tunjangan-masa-kerja-view">


    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_tunjangan_masa_kerja',
            'id_karyawan',
            'tgl',
            'aktif',
            'nominal',
            'keterangan:ntext',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_tunjangan_masa_kerja], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_tunjangan_masa_kerja], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
