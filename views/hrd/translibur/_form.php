<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\widgets\TimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransLibur */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-libur-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        echo $form->field($model, 'tgl')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Tanggal Sakit'],
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
    ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
