<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterGroup */

$this->title = $model->id_group;
$this->params['breadcrumbs'][] = ['label' => 'Master Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-group-view">

<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_group',
            'nama_group',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_group], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_group], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>



</div>
