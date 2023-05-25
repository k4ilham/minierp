<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransTunjanganKeahlian */

$this->title = 'Update Trans Tunjangan Keahlian: ' . $model->id_tunjangan_keahlian;
$this->params['breadcrumbs'][] = ['label' => 'Trans Tunjangan Keahlians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tunjangan_keahlian, 'url' => ['view', 'id' => $model->id_tunjangan_keahlian]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-tunjangan-keahlian-update">



    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
    ]) ?>

</div>
