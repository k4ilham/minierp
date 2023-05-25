<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransSakit */

$this->title = 'Create Trans Absen';
$this->params['breadcrumbs'][] = ['label' => 'Trans Absen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-Absen-create">

    <?= $this->render('_form2', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
