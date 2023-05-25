<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransAbsensi */

$this->title = 'Create Trans Absensi';
$this->params['breadcrumbs'][] = ['label' => 'Trans Absensis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-absensi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list_periode' => $list_periode,
    ]) ?>

</div>
