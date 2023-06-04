<?php

use yii\helpers\Html;


$this->title = 'Create Sales Order';
$this->params['breadcrumbs'][] = ['label' => 'Sales Order', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-trans-sales-order-header-create">


    <?= $this->render('_form', [
        'model' => $model,
        'listCustomer' => $listCustomer,
        'listKaryawan' => $listKaryawan,
    ]) ?>

</div>
