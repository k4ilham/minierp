<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransPotonganKedisplinan */

$this->title = 'Update Trans Potongan Kedisplinan: ' . $model->id_potongan_kedisplinan;
$this->params['breadcrumbs'][] = ['label' => 'Trans Potongan Kedisplinans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_potongan_kedisplinan, 'url' => ['view', 'id' => $model->id_potongan_kedisplinan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-potongan-kedisplinan-update">

    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
