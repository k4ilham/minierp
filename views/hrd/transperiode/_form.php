<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Transperiode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transperiode-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'periode')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
