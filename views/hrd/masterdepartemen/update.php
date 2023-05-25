<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterDepartemen */

$this->title = 'Update Master Departemen: ' . $model->id_departemen;
$this->params['breadcrumbs'][] = ['label' => 'Master Departemens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_departemen, 'url' => ['view', 'id' => $model->id_departemen]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-departemen-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
