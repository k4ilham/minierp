<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterGroup */

$this->title = 'Update Master Group: ' . $model->id_group;
$this->params['breadcrumbs'][] = ['label' => 'Master Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_group, 'url' => ['view', 'id' => $model->id_group]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-group-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
