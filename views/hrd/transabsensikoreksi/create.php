<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransAbsensiKoreksi */

$this->title = 'Create Trans Absensi Koreksi';
$this->params['breadcrumbs'][] = ['label' => 'Trans Absensi Koreksis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-absensi-koreksi-create">



    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
        'listperiode' => $listperiode,
    ]) ?>

</div>
