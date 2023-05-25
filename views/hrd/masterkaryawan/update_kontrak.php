<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransBank */

$this->title = 'Update Kontrak';
$this->params['breadcrumbs'][] = ['label' => 'Update Kontrak', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-bank-update">
    <?= $this->render('_form_kontrak', [
        'model' => $model,
    ]) ?>
</div>
