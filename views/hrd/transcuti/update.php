<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransCuti */

$this->title = 'Update Trans Cuti: ' . $model->id_cuti;
$this->params['breadcrumbs'][] = ['label' => 'Trans Cutis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cuti, 'url' => ['view', 'id' => $model->id_cuti]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-cuti-update">

    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
