<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransSakit */

$this->title = 'Create Trans Off';
$this->params['breadcrumbs'][] = ['label' => 'Trans Off', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-Off-create">

    <?= $this->render('_form2', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
