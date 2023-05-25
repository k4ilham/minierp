<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterDepartemen */

$this->title = $model->id_departemen;
$this->params['breadcrumbs'][] = ['label' => 'Master Departemens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-departemen-view">




    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_departemen',
            'nama_departemen',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>


<p>
        <?= Html::a('Update', ['update', 'id' => $model->id_departemen], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_departemen], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
