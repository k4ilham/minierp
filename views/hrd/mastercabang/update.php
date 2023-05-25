<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterCabang */

$this->title = 'Update Master Cabang: ' . $model->id_cabang;
$this->params['breadcrumbs'][] = ['label' => 'Master Cabangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cabang, 'url' => ['view', 'id' => $model->id_cabang]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-cabang-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
