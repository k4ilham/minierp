<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransSakit */

$this->title = 'Create Trans Sakit';
$this->params['breadcrumbs'][] = ['label' => 'Trans Sakits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-sakit-create">

    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
