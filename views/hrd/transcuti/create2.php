<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransSakit */

$this->title = 'Create Trans Cuti';
$this->params['breadcrumbs'][] = ['label' => 'Trans Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-Cuti-create">

    <?= $this->render('_form2', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
