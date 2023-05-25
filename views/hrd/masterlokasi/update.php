<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterLokasi */

$this->title = 'Update Master Lokasi: ' . $model->id_lokasi;
$this->params['breadcrumbs'][] = ['label' => 'Master Lokasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_lokasi, 'url' => ['view', 'id' => $model->id_lokasi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-lokasi-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
