<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterDivisi */

$this->title = 'Update Master Divisi: ' . $model->id_divisi;
$this->params['breadcrumbs'][] = ['label' => 'Master Divisis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_divisi, 'url' => ['view', 'id' => $model->id_divisi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-divisi-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
