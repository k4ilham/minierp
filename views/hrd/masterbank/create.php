<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterBank */

$this->title = 'Create Master Bank';
$this->params['breadcrumbs'][] = ['label' => 'Master Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-bank-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
