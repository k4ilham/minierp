<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransGajiPokok */

$this->title = 'Create Gaji Pokok';
$this->params['breadcrumbs'][] = ['label' => 'Trans Gaji Pokoks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-gaji-pokok-create">

    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
    ]) ?>

</div>
