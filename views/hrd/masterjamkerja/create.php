<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterJamKerja */

$this->title = 'Create Master Jam Kerja';
$this->params['breadcrumbs'][] = ['label' => 'Master Jam Kerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-jam-kerja-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
