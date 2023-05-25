<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterStatus */

$this->title = 'Update Master Status: ' . $model->id_status;
$this->params['breadcrumbs'][] = ['label' => 'Master Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_status, 'url' => ['view', 'id' => $model->id_status]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-status-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
