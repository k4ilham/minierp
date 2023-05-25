<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransCutiKhusus */

$this->title = 'Update Trans Cuti Khusus: ' . $model->id_cuti_khusus;
$this->params['breadcrumbs'][] = ['label' => 'Trans Cuti Khususes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cuti_khusus, 'url' => ['view', 'id' => $model->id_cuti_khusus]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-cuti-khusus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
