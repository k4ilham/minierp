<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Mastervendor */

$this->title = $model->id_vendor;
$this->params['breadcrumbs'][] = ['label' => 'Master vendors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-vendor-view">





    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_vendor',
            'nama_vendor',
            [
                'attribute' => 'created_by',
                'format' => 'html',
                'value' => function ($model) {
                    return Yii::$app->helperdb->getField("user","id","username",$model->created_by);

                },
            ],
            [
                'attribute' => 'updated_by',
                'format' => 'html',
                'value' => function ($model) {
                    return Yii::$app->helperdb->getField("user","id","username",$model->updated_by);
                },
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

<p>
        <?= Html::a('Update', ['update', 'id' => $model->id_vendor], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_vendor], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
