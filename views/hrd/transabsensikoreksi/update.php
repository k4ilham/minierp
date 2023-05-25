<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransAbsensiKoreksi */

$this->title = 'Update Trans Absensi Koreksi: ' . $model->id_absensi_koreksi;
$this->params['breadcrumbs'][] = ['label' => 'Trans Absensi Koreksis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_absensi_koreksi, 'url' => ['view', 'id' => $model->id_absensi_koreksi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-absensi-koreksi-update">



    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
