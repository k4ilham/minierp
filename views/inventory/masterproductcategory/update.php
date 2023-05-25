<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Master_product_category */

$this->title = 'Update Master _product_category: ' . $model->id_product_category;
$this->params['breadcrumbs'][] = ['label' => 'Master _product_categorys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_product_category, 'url' => ['view', 'id' => $model->id_product_category]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-_product_category-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
