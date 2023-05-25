<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransAbsensi */

$this->title = 'Update Rate Kehadiran:';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-absensi-update">


    <?= $this->render('_form_jamkerja', [
        'model' => $model,
        'listJamKerja' => $listJamKerja,
    ]) ?>

</div>
