<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransIjin */

$this->title = $model->id_ijin;
$this->params['breadcrumbs'][] = ['label' => 'Trans Ijins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trans-ijin-view">





    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_ijin',
            'id_karyawan',
            'periode',
            'tgl_ijin',
            'keterangan:ntext',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

<p>
        <?= Html::a('Update', ['update', 'id' => $model->id_ijin], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_ijin], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
