<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use Da\QrCode\QrCode;


/* @var $this yii\web\View */
/* @var $model app\models\hrd\Masterproduct */

$this->title = $model->id_sales_order_header;
$this->params['breadcrumbs'][] = ['label' => 'Master products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-trans-sales-order-view">


<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'kode_sales_order', 
        [
            'attribute' => 'status',
            'format' => 'html',
            'value' => function ($model) {
                return Yii::$app->helperdb->getStatus($model->status);

            },
        ],
        [
            'attribute' => 'id_customer',
            'format' => 'html',
            'value' => function ($model) {
                return Yii::$app->helperdb->getField("master_customer","id_customer","nama_customer",$model->id_customer);

            },
        ],
        [
            'attribute' => 'sales_person_code',
            'format' => 'html',
            'value' => function ($model) {
                return  Yii::$app->helperdb->getField("master_karyawan","id_karyawan","nama_karyawan",$model->sales_person_code);

            },
        ],
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
    <?php if($model->status==0){ ?>
        <?= Html::a('Update', ['update', 'id' => $model->id_sales_order_header], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Complete', ['status-complete', 'id' => $model->id_sales_order_header], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Are you sure you want to complete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?= Html::a('Void', ['status-void', 'id' => $model->id_sales_order_header], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to void this item?',
                'method' => 'post',
            ],
        ]) ?>

    <?php }else if($model->status==1){ ?>
        <?= Html::a('Void', ['status-void', 'id' => $model->id_sales_order_header], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to void this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?php }else if($model->status==2){ ?>
        <?= Html::a('Open', ['status-open', 'id' => $model->id_sales_order_header], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => 'Are you sure you want to open this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?php } ?>

    </p>

<p align="right">
<?php 
$qrCode = (new QrCode($model->kode_sales_order))
    ->setSize(100)
    ->setMargin(5);
echo '<img src="' . $qrCode->writeDataUri() . '">';
echo '<br>';
echo $model->kode_sales_order;
?>
</p> 

</div>



