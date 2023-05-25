<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransLibur */

$this->title = 'Update Trans Libur: ' . $model->id_libur;
$this->params['breadcrumbs'][] = ['label' => 'Trans Liburs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_libur, 'url' => ['view', 'id' => $model->id_libur]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-libur-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
