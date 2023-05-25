<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransCutiKhusus */

$this->title = 'Create Trans Cuti Khusus';
$this->params['breadcrumbs'][] = ['label' => 'Trans Cuti Khususes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-cuti-khusus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
