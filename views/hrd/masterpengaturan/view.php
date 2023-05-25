<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterPengaturan */

$this->title = $model->id_pengaturan;
$this->params['breadcrumbs'][] = ['label' => 'Master Pengaturans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-pengaturan-view">




    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_pengaturan',
            'perusahaan',
            'akronim',
            'alamat:ntext',
            'telp',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

<p>
        <?= Html::a('Update', ['update', 'id' => $model->id_pengaturan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_pengaturan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
