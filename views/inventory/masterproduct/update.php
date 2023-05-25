<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Master_product */

$this->title = 'Update Master _product: ' . $model->id_product;
$this->params['breadcrumbs'][] = ['label' => 'Master _products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_product, 'url' => ['view', 'id' => $model->id_product]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-_product-update">


    <?= $this->render('_form', [
        'model' => $model,
        'listproductcategory' => $listproductcategory,
    ]) ?>

</div>
