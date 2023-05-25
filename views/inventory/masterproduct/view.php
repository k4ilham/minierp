<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use Da\QrCode\QrCode;


/* @var $this yii\web\View */
/* @var $model app\models\hrd\Masterproduct */

$this->title = $model->id_product;
$this->params['breadcrumbs'][] = ['label' => 'Master products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-product-view">






<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'attribute' => 'photo',
            'format' => 'html',
            'value' => function ($model) {
                return Html::img(Url::base(true).'/file/uploads/product/'.$model->photo, ['width' => '200px']);
            },
        ],
        [
            'attribute' => 'id_product_category',
            'format' => 'html',
            'value' => function ($model) {
                return Yii::$app->helperdb->getProductCategoryName($model->id_product_category);
            },
        ],
        'kode_product',
        'nama_product',
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
        <?= Html::a('Update', ['update', 'id' => $model->id_product], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_product], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<p align="right">
<?php 
$qrCode = (new QrCode($model->kode_product))
    ->setSize(100)
    ->setMargin(5);
//$qrCode->writeFile(__DIR__ . '/code.png'); // writer defaults to PNG when none is specified
echo '<img src="' . $qrCode->writeDataUri() . '">';
echo '<br>';
echo $model->kode_product;
?>
</p> 

</div>



