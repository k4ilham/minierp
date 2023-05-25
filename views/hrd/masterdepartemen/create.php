<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterDepartemen */

$this->title = 'Create Master Departemen';
$this->params['breadcrumbs'][] = ['label' => 'Master Departemens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-departemen-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
