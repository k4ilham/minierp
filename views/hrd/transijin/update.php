<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransIjin */

$this->title = 'Update Trans Ijin: ' . $model->id_ijin;
$this->params['breadcrumbs'][] = ['label' => 'Trans Ijins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_ijin, 'url' => ['view', 'id' => $model->id_ijin]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-ijin-update">


    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
