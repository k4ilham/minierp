<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterBank */

$this->title = 'Update Master Bank: ' . $model->id_bank;
$this->params['breadcrumbs'][] = ['label' => 'Master Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_bank, 'url' => ['view', 'id' => $model->id_bank]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-bank-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
