<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterPengaturan */

$this->title = 'Create Master Pengaturan';
$this->params['breadcrumbs'][] = ['label' => 'Master Pengaturans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-pengaturan-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
