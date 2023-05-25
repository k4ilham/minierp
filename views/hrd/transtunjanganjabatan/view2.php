<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransTunjanganJabatan */

$this->title = $model->id_tunjangan_jabatan;
$this->params['breadcrumbs'][] = ['label' => 'Trans Tunjangan Jabatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trans-tunjangan-jabatan-view">





    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_tunjangan_jabatan',
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
        <?= Html::a('Update', ['update', 'id' => $model->id_tunjangan_jabatan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_tunjangan_jabatan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
