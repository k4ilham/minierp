<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransPotonganKedisplinan */

$this->title = $model->id_potongan_kedisplinan;
$this->params['breadcrumbs'][] = ['label' => 'Trans Potongan Kedisplinans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trans-potongan-kedisplinan-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_potongan_kedisplinan',
            'id_karyawan',
            'tgl',
            'periode',
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
        <?= Html::a('Update', ['update', 'id' => $model->id_potongan_kedisplinan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_potongan_kedisplinan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
