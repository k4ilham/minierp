<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterCutiKhusus */

$this->title = 'Create Master Cuti Khusus';
$this->params['breadcrumbs'][] = ['label' => 'Master Cuti Khususes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-cuti-khusus-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
