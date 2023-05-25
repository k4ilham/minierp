<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransSakit */

$this->title = 'Update Trans Sakit: ' . $model->id_sakit;
$this->params['breadcrumbs'][] = ['label' => 'Trans Sakits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sakit, 'url' => ['view', 'id' => $model->id_sakit]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-sakit-update">

    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
