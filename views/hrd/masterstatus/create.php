<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterStatus */

$this->title = 'Create Master Status';
$this->params['breadcrumbs'][] = ['label' => 'Master Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-status-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
