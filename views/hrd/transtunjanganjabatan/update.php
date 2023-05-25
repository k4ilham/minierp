<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransTunjanganJabatan */

$this->title = 'Update Trans Tunjangan Jabatan: ' . $model->id_tunjangan_jabatan;
$this->params['breadcrumbs'][] = ['label' => 'Trans Tunjangan Jabatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tunjangan_jabatan, 'url' => ['view', 'id' => $model->id_tunjangan_jabatan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-tunjangan-jabatan-update">



    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
    ]) ?>

</div>
