<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterKalender */

$this->title = 'Update Master Kalender: ' . $model->id_kalender;
$this->params['breadcrumbs'][] = ['label' => 'Master Kalenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_kalender, 'url' => ['view', 'id' => $model->id_kalender]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-kalender-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list_tahun' => $list_tahun,
        'list_bulan' => $list_bulan,
    ]) ?>

</div>
