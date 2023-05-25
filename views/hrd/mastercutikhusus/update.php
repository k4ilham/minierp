<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterCutiKhusus */

$this->title = 'Update Master Cuti Khusus: ' . $model->id_master_cuti_khusus;
$this->params['breadcrumbs'][] = ['label' => 'Master Cuti Khususes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_master_cuti_khusus, 'url' => ['view', 'id' => $model->id_master_cuti_khusus]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-cuti-khusus-update">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
