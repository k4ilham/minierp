<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransUser */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Update', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-user-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
