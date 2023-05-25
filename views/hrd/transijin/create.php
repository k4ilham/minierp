<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransIjin */

$this->title = 'Create Trans Ijin';
$this->params['breadcrumbs'][] = ['label' => 'Trans Ijins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-ijin-create">

    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
