<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Transperiode */

$this->title = 'Update Periode: ' . $model->id_periode;
$this->params['breadcrumbs'][] = ['label' => 'Periode', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_periode, 'url' => ['view', 'id' => $model->id_periode]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transperiode-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
