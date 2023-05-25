<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransAbsensiManual */

$this->title = 'Update Trans Absensi Manual: ' . $model->id_absensi_manual;
$this->params['breadcrumbs'][] = ['label' => 'Trans Absensi Manuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_absensi_manual, 'url' => ['view', 'id' => $model->id_absensi_manual]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-absensi-manual-update">



    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
