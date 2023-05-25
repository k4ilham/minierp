<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterBank */

$this->title = $model->id_bank;
$this->params['breadcrumbs'][] = ['label' => 'Master Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-bank-view">





    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_bank',
            'nama_bank',
            'kode_bank',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

<p>
        <?= Html::a('Update', ['update', 'id' => $model->id_bank], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_bank], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
