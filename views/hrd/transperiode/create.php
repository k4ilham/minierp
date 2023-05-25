<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Transperiode */

$this->title = 'Tambah Periode';
$this->params['breadcrumbs'][] = ['label' => 'Periode', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transperiode-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
