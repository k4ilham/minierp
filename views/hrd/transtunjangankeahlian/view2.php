<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransTunjanganKeahlian */

$this->title = $model->id_tunjangan_keahlian;
$this->params['breadcrumbs'][] = ['label' => 'Trans Tunjangan Keahlians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trans-tunjangan-keahlian-view">





    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

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
        <?= Html::a('Update', ['update', 'id' => $model->id_tunjangan_keahlian], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_tunjangan_keahlian], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
