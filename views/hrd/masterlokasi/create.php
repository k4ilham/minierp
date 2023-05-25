<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterLokasi */

$this->title = 'Create Master Lokasi';
$this->params['breadcrumbs'][] = ['label' => 'Master Lokasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-lokasi-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
