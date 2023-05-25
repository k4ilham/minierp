<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterGroup */

$this->title = 'Create Master Group';
$this->params['breadcrumbs'][] = ['label' => 'Master Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-group-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
