<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\MasterJamKerjaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-jam-kerja-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_jam_kerja') ?>

    <?= $form->field($model, 'nama_jam_kerja') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?= $form->field($model, 'jam_masuk') ?>

    <?= $form->field($model, 'jam_istirahat') ?>

    <?php // echo $form->field($model, 'jam_pulang') ?>

    <?php // echo $form->field($model, 'sabtu_masuk') ?>

    <?php // echo $form->field($model, 'minggu_masuk') ?>

    <?php // echo $form->field($model, 'jenis') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
