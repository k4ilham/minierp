<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TranslogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="translog-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_log') ?>

    <?= $form->field($model, 'timelog') ?>

    <?= $form->field($model, 'desc') ?>

    <?= $form->field($model, 'id_user') ?>

    <?= $form->field($model, 'userIP') ?>

    <?php // echo $form->field($model, 'scriptUrl') ?>

    <?php // echo $form->field($model, 'scriptFile') ?>

    <?php // echo $form->field($model, 'pathInfo') ?>

    <?php // echo $form->field($model, 'port') ?>

    <?php // echo $form->field($model, 'method') ?>

    <?php // echo $form->field($model, 'origin') ?>

    <?php // echo $form->field($model, 'userAgent') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
