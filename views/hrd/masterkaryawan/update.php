<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterKaryawan */

$this->title = 'Update Master Karyawan: ' . $model->id_karyawan;
$this->params['breadcrumbs'][] = ['label' => 'Master Karyawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_karyawan, 'url' => ['view', 'id' => $model->id_karyawan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-karyawan-update">

    <?= $this->render('_form_update', [
        'model' => $model,
        'listDepartemen' => $listDepartemen,
        'listStatus' => $listStatus,
        'listJabatan' => $listJabatan,
        'listLokasi' => $listLokasi,
        'listGroup' => $listGroup,
        'listJamKerja' => $listJamKerja,
    ]) ?>

</div>
