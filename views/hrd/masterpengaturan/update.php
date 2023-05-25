<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterPengaturan */

$this->title = 'Update Master Pengaturan: ' . $model->id_pengaturan;
$this->params['breadcrumbs'][] = ['label' => 'Master Pengaturans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pengaturan, 'url' => ['view', 'id' => $model->id_pengaturan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-pengaturan-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
