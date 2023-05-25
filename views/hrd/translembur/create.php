<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransLembur */

$this->title = 'Create Trans Lembur';
$this->params['breadcrumbs'][] = ['label' => 'Trans Lemburs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-lembur-create">


    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
