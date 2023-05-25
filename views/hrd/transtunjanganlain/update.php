<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransTunjanganLain */

$this->title = 'Update Trans Tunjangan Lain: ' . $model->id_tunjangan_lain;
$this->params['breadcrumbs'][] = ['label' => 'Trans Tunjangan Lains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tunjangan_lain, 'url' => ['view', 'id' => $model->id_tunjangan_lain]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-tunjangan-lain-update">

    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
