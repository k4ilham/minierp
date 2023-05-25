<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransBank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-bank-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        echo $form->field($model, 'id_karyawan')->widget(Select2::classname(), [
            'data' => $listkar,
            'options' => ['placeholder' => 'Pilih Karyawan'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?php
        echo $form->field($model, 'id_bank')->widget(Select2::classname(), [
            'data' => $listbank,
            'options' => ['placeholder' => 'Pilih Bank'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'norek')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'atasnama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cabang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kota')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
