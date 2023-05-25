<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Masterproduct_category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-product-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_category')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'photo')->fileInput() ?>
                    



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
