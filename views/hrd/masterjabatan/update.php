<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterJabatan */

$this->title = 'Update Master Jabatan: ' . $model->id_jabatan;
$this->params['breadcrumbs'][] = ['label' => 'Master Jabatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_jabatan, 'url' => ['view', 'id' => $model->id_jabatan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-jabatan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
