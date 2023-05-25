<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransAbsensi */

$this->title = 'Update Trans Absensi: ' . $model->id_absensi;
$this->params['breadcrumbs'][] = ['label' => 'Trans Absensis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_absensi, 'url' => ['view', 'id' => $model->id_absensi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-absensi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list_periode' => $list_periode,
    ]) ?>

</div>
