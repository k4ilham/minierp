<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterCutiKhusus */

$this->title = $model->id_master_cuti_khusus;
$this->params['breadcrumbs'][] = ['label' => 'Master Cuti Khususes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-cuti-khusus-view">

<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_cuti',
            'jml_hari_cuti',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_master_cuti_khusus], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_master_cuti_khusus], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>



</div>
