<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransLibur */

$this->title = 'Create Trans Libur';
$this->params['breadcrumbs'][] = ['label' => 'Trans Liburs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-libur-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
