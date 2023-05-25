<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_status')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
