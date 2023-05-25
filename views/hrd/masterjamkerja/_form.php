<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterJamKerja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-jam-kerja-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_jam_kerja')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jam_masuk')->textInput() ?>

    <?= $form->field($model, 'jam_istirahat')->textInput() ?>

    <?= $form->field($model, 'jam_pulang')->textInput() ?>

    <?= $form->field($model, 'sabtu_masuk')->textInput() ?>

    <?= $form->field($model, 'minggu_masuk')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
