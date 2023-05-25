<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransPotonganKedisplinan */

$this->title = 'Create Trans Potongan Kedisplinan';
$this->params['breadcrumbs'][] = ['label' => 'Trans Potongan Kedisplinans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-potongan-kedisplinan-create">
    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
