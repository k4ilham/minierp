<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterLokasi */

$this->title = $model->id_lokasi;
$this->params['breadcrumbs'][] = ['label' => 'Master Lokasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-lokasi-view">





    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_lokasi',
            'nama_lokasi',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>


<p>
        <?= Html::a('Update', ['update', 'id' => $model->id_lokasi], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_lokasi], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
