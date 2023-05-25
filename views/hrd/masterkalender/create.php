<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterKalender */

$this->title = 'Create Master Kalender';
$this->params['breadcrumbs'][] = ['label' => 'Master Kalenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-kalender-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list_tahun' => $list_tahun,
        'list_bulan' => $list_bulan,
    ]) ?>

</div>
