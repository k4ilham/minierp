<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterJamKerja */

$this->title = $model->id_jam_kerja;
$this->params['breadcrumbs'][] = ['label' => 'Master Jam Kerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-jam-kerja-view">




    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_jam_kerja',
            'nama_jam_kerja'
        ],
    ]) ?>


<p>
        <?= Html::a('Update', ['update', 'id' => $model->id_jam_kerja], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_jam_kerja], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
