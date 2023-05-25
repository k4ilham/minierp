<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterKaryawan */

$this->title = 'Create Master Karyawan';
$this->params['breadcrumbs'][] = ['label' => 'Master Karyawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-karyawan-create">
    <?= $this->render('_form', [
        'model' => $model,
        'listDepartemen' => $listDepartemen,
        'listStatus' => $listStatus,
        'listJabatan' => $listJabatan,
        'listLokasi' => $listLokasi,
        'listGroup' => $listGroup,
    ]) ?>
</div>
