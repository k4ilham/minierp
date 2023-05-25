<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransAbsensiManual */

$this->title = 'Create Trans Absensi Manual';
$this->params['breadcrumbs'][] = ['label' => 'Trans Absensi Manuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-absensi-manual-create">



    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
