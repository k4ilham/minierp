<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransOff */

$this->title = 'Create Trans Off';
$this->params['breadcrumbs'][] = ['label' => 'Trans Offs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-off-create">


    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
