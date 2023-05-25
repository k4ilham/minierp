<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterCabang */

$this->title = 'Create Master Product Category';
$this->params['breadcrumbs'][] = ['label' => 'Master Product Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-product-category-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
