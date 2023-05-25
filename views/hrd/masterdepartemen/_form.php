<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterDepartemen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-departemen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_departemen')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
