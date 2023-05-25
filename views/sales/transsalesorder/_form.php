<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

?>

<div class="master-sales-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_customer')->widget(Select2::classname(), [
        'data' => $listCustomer,
        'options' => ['placeholder' => 'Customer Name'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Customer Name'); ?>


    <?= $form->field($model, 'id_customer_bill_to')->widget(Select2::classname(), [
        'data' => $listCustomer,
        'options' => ['placeholder' => 'Bill To'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Bill To'); ?>

    <?= $form->field($model, 'id_customer_sell_to')->widget(Select2::classname(), [
        'data' => $listCustomer,
        'options' => ['placeholder' => 'Sell To'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Sell To'); ?>

    <?= $form->field($model, 'ship_to_name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'ship_to_address')->textarea(['maxlength' => true, 'rows' => 4, 'cols' => 40]) ?>


    <?php

        echo $form->field($model, 'sales_person_code')->widget(Select2::classname(), [
            'data' => $listKaryawan,
            'options' => ['placeholder' => 'Sales Person'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Sales Person');
    ?>

    <?php
        echo $form->field($model, 'order_date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Order_date'],
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
    ?>



    <?= $form->field($model, 'ext_doc_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => 4, 'cols' => 40]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
$(document).ready(function() {
    $('#<?= Html::getInputId($model, 'id_customer') ?>').on('change', function() {
        var selectedCustomerId = $(this).val();
        var selectedCustomerName = $(this).find('option:selected').text();

        // Set selectedCustomerId as the value for id_customer_sell_to
        $('#<?= Html::getInputId($model, 'id_customer_sell_to') ?>').val(selectedCustomerId).trigger('change');

        // Set selectedCustomerId as the value for id_customer_bill_to
        $('#<?= Html::getInputId($model, 'id_customer_bill_to') ?>').val(selectedCustomerId).trigger('change');

        // Set selectedCustomerName as the value for ship_to_name
        $('#<?= Html::getInputId($model, 'ship_to_name') ?>').val(selectedCustomerName);
    });

    $('#<?= Html::getInputId($model, 'id_customer_sell_to') ?>').on('change', function() {
        var selectedCustomerId = $(this).val();
        var selectedCustomerName = $(this).find('option:selected').text();
        // Set selectedCustomerName as the value for ship_to_name
        $('#<?= Html::getInputId($model, 'ship_to_name') ?>').val(selectedCustomerName);
    });
});

</script>

