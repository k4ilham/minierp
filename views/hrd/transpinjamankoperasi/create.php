<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransPinjamanKoperasi */

$this->title = 'Create Trans Pinjaman Koperasi';
$this->params['breadcrumbs'][] = ['label' => 'Trans Pinjaman Koperasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-pinjaman-koperasi-create">

    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
    ]) ?>

</div>
