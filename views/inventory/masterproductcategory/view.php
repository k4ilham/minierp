<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Masterproduct_category */

$this->title = $model->id_product_category;
$this->params['breadcrumbs'][] = ['label' => 'Master product_categorys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-product_category-view">





    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'photo',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img(Url::base(true).'/file/uploads/product_category/'.$model->photo, ['width' => '200px']);
                },
            ],
            'product_category',
            [
                'attribute' => 'created_by',
                'format' => 'html',
                'value' => function ($model) {
                    return Yii::$app->helperdb->getName($model->created_by);
                },
            ],
            [
                'attribute' => 'updated_by',
                'format' => 'html',
                'value' => function ($model) {
                    return Yii::$app->helperdb->getName($model->updated_by);
                },
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

<p>
        <?= Html::a('Update', ['update', 'id' => $model->id_product_category], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_product_category], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
