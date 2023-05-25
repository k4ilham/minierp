<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransperiodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transperiode-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_periode') ?>

    <?= $form->field($model, 'periode') ?>

    <?= $form->field($model, 'aktif') ?>

    <?= $form->field($model, 'tgl_gaji') ?>

    <?= $form->field($model, 'tgl_absen_awal') ?>

    <?php // echo $form->field($model, 'tgl_absen_akhir') ?>

    <?php // echo $form->field($model, 'tgl_posting') ?>

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
