<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransBankSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-bank-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_transbank') ?>

    <?= $form->field($model, 'id_karyawan') ?>

    <?= $form->field($model, 'id_bank') ?>

    <?= $form->field($model, 'norek') ?>

    <?= $form->field($model, 'atasnama') ?>

    <?php // echo $form->field($model, 'cabang') ?>

    <?php // echo $form->field($model, 'kota') ?>

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
