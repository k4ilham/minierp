<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Master_product */

$this->title = 'Update Sales Order: ' . $model->id_sales_order_header;
$this->params['breadcrumbs'][] = ['label' => 'Sales Order', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sales_order_header, 'url' => ['view', 'id' => $model->id_sales_order_header]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-trans-sales-order-header-update">


    <?= $this->render('_form', [
        'model' => $model,
        'listCustomer' => $listCustomer,
        'listKaryawan' => $listKaryawan,
    ]) ?>

</div>
