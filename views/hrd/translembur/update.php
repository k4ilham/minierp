<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransLembur */

$this->title = 'Update Trans Lembur: ' . $model->id_lembur;
$this->params['breadcrumbs'][] = ['label' => 'Trans Lemburs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_lembur, 'url' => ['view', 'id' => $model->id_lembur]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-lembur-update">


    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
