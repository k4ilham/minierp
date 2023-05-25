<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransOff */

$this->title = 'Update Trans Off: ' . $model->id_off;
$this->params['breadcrumbs'][] = ['label' => 'Trans Offs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_off, 'url' => ['view', 'id' => $model->id_off]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-off-update">


    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
