<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransPotonganLain */

$this->title = 'Create Trans Potongan Lain';
$this->params['breadcrumbs'][] = ['label' => 'Trans Potongan Lains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-potongan-lain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
