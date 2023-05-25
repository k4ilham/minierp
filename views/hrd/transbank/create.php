<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransBank */

$this->title = 'Create Trans Bank';
$this->params['breadcrumbs'][] = ['label' => 'Trans Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-bank-create">

    <?= $this->render('_form', [
        'model' => $model,
        'listbank' => $listbank,
    ]) ?>

</div>
