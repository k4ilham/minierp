<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Master_customer */

$this->title = 'Update Master _customer: ' . $model->id_customer;
$this->params['breadcrumbs'][] = ['label' => 'Master _customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_customer, 'url' => ['view', 'id' => $model->id_customer]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-_customer-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
