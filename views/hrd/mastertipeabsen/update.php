<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterTipeabsen */

$this->title = 'Update Master Tipeabsen: ' . $model->id_tipeabsen;
$this->params['breadcrumbs'][] = ['label' => 'Master Tipeabsens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipeabsen, 'url' => ['view', 'id' => $model->id_tipeabsen]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-tipeabsen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
