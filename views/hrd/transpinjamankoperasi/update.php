<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransPinjamanKoperasi */

$this->title = 'Update Trans Pinjaman Koperasi: ' . $model->id_pinjaman_koperasi;
$this->params['breadcrumbs'][] = ['label' => 'Trans Pinjaman Koperasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pinjaman_koperasi, 'url' => ['view', 'id' => $model->id_pinjaman_koperasi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-pinjaman-koperasi-update">


    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
    ]) ?>

</div>
