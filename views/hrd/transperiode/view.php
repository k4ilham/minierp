<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Transperiode */

$this->title = $model->id_periode;
$this->params['breadcrumbs'][] = ['label' => 'Periode', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transperiode-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_periode',
            'periode',
            'aktif',
            'tgl_gaji',
            'tgl_absen_awal',
            'tgl_absen_akhir',
            'tgl_posting',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_periode], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_periode], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
