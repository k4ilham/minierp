<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransPotonganLain */

$this->title = 'Update Trans Potongan Lain: ' . $model->id_potongan_lain;
$this->params['breadcrumbs'][] = ['label' => 'Trans Potongan Lains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_potongan_lain, 'url' => ['view', 'id' => $model->id_potongan_lain]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-potongan-lain-update">

    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
