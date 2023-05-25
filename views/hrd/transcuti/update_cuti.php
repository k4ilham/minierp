<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransAbsensi */

$this->title = 'Update Rate cuti:';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-cuti-update">
    <?= $this->render('_form_cuti', [
        'model' => $model,
    ]) ?>
</div>
