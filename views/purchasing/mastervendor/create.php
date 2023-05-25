<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterCabang */

$this->title = 'Create Master vendor';
$this->params['breadcrumbs'][] = ['label' => 'Master vendor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-vendor-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
