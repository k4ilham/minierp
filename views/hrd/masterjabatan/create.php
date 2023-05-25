<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterJabatan */

$this->title = 'Create Master Jabatan';
$this->params['breadcrumbs'][] = ['label' => 'Master Jabatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-jabatan-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
