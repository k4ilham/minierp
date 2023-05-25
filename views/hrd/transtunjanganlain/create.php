<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransTunjanganLain */

$this->title = 'Create Trans Tunjangan Lain';
$this->params['breadcrumbs'][] = ['label' => 'Trans Tunjangan Lains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-tunjangan-lain-create">


    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
