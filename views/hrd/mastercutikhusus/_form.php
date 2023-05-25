<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterCutiKhusus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-cuti-khusus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_cuti')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jml_hari_cuti')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
