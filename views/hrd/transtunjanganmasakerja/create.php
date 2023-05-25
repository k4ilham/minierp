<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransTunjanganMasaKerja */

$this->title = 'Create Trans Tunjangan Masa Kerja';
$this->params['breadcrumbs'][] = ['label' => 'Trans Tunjangan Masa Kerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-tunjangan-masa-kerja-create">

    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
    ]) ?>

</div>
