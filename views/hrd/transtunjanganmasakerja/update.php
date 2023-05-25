<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransTunjanganMasaKerja */

$this->title = 'Update Trans Tunjangan Masa Kerja: ' . $model->id_tunjangan_masa_kerja;
$this->params['breadcrumbs'][] = ['label' => 'Trans Tunjangan Masa Kerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tunjangan_masa_kerja, 'url' => ['view', 'id' => $model->id_tunjangan_masa_kerja]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-tunjangan-masa-kerja-update">

    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
    ]) ?>

</div>
