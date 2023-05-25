<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Master_vendor */

$this->title = 'Update Master _vendor: ' . $model->id_vendor;
$this->params['breadcrumbs'][] = ['label' => 'Master _vendors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_vendor, 'url' => ['view', 'id' => $model->id_vendor]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-_vendor-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
