<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransGajiPokok */

$this->title = 'Update Trans Gaji Pokok ';
$this->params['breadcrumbs'][] = ['label' => 'Trans Gaji Pokoks', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-gaji-pokok-update">


    <?= $this->render('_form_gapok', [
        'model' => $model,
        'listDepartemen' => $listDepartemen,
        'listStatus' => $listStatus,
        'listJabatan' => $listJabatan,
        'listLokasi' => $listLokasi,
        'umr' => $umr,
    ]) ?>

</div>
