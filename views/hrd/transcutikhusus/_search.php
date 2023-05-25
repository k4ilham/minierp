<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TranCutiKhususSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-cuti-khusus-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_cuti_khusus') ?>

    <?= $form->field($model, 'id_karyawan') ?>

    <?= $form->field($model, 'jenis_cuti') ?>

    <?= $form->field($model, 'periode') ?>

    <?= $form->field($model, 'tgl_awal') ?>

    <?php // echo $form->field($model, 'tgl_akhir') ?>

    <?php // echo $form->field($model, 'jml_hari') ?>

    <?php // echo $form->field($model, 'saldo_cuti') ?>

    <?php // echo $form->field($model, 'saldo_cuti_lalu') ?>

    <?php // echo $form->field($model, 'potong_cuti') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

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
