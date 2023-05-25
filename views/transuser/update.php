<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransUser */

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Update User', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
