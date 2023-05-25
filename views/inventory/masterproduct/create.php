<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterCabang */

$this->title = 'Create Master product';
$this->params['breadcrumbs'][] = ['label' => 'Master product', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-product-create">


    <?= $this->render('_form', [
        'model' => $model,
        'listproductcategory' => $listproductcategory,
    ]) ?>

</div>
