<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Mastercustomer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_customer')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
