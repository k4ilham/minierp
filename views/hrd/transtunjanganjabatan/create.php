<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransTunjanganJabatan */

$this->title = 'Create Trans Tunjangan Jabatan';
$this->params['breadcrumbs'][] = ['label' => 'Trans Tunjangan Jabatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-tunjangan-jabatan-create">

 

    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
    ]) ?>

</div>
