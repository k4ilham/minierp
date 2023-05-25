<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransPinjamanKoperasi */

$this->title = $model->id_pinjaman_koperasi;
$this->params['breadcrumbs'][] = ['label' => 'Trans Pinjaman Koperasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trans-pinjaman-koperasi-view">




    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_pinjaman_koperasi',
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
        <?= Html::a('Update', ['update', 'id' => $model->id_pinjaman_koperasi], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_pinjaman_koperasi], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


</div>
