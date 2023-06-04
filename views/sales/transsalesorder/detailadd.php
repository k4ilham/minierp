<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Master_product */

$this->title = 'Add Detail: ' . $model->id_sales_order_header;
$this->params['breadcrumbs'][] = ['label' => 'Add Detail', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sales_order_header, 'url' => ['view', 'id' => $model->id_sales_order_header]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-trans-sales-order-detail-add">


    <?= $this->render('_form_detail', [
        'model' => $model,
        'listProduct' => $listProduct,
        'listKaryawan' => $listKaryawan,
    ]) ?>

</div>
