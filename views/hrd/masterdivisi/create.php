<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterDivisi */

$this->title = 'Create Master Divisi';
$this->params['breadcrumbs'][] = ['label' => 'Master Divisis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-divisi-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
