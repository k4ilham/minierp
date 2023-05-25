<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterCabang */

$this->title = 'Create Master Customer';
$this->params['breadcrumbs'][] = ['label' => 'Master Customer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-customer-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
