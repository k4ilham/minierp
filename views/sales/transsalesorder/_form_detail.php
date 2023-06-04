<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

?>

<div class="master-sales-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_product')->widget(Select2::classname(), [
        'data' => $listProduct,
        'options' => ['placeholder' => 'Product Name'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Product Name'); ?>

    <?= $form->field($model, 'qty')->textInput(['type' => 'number', 'step' => 'any']) ?>

    <?= $form->field($model, 'price')->textInput(['type' => 'number', 'step' => 'any']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


