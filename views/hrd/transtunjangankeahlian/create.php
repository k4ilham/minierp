<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransTunjanganKeahlian */

$this->title = 'Create Trans Tunjangan Keahlian';
$this->params['breadcrumbs'][] = ['label' => 'Trans Tunjangan Keahlians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-tunjangan-keahlian-create">



    <?= $this->render('_form', [
        'model' => $model,
        'listkar' => $listkar,
    ]) ?>

</div>
