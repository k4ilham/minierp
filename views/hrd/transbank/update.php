<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransBank */

$this->title = 'Update Trans Bank';
$this->params['breadcrumbs'][] = ['label' => 'Trans Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-bank-update">
    <?= $this->render('_form_bank', [
        'model' => $model,
        'listbank' => $listbank,
    ]) ?>
</div>
