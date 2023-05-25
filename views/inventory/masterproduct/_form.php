<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\Masterproduct */
/* @var $form yii\widgets\ActiveForm */
?>
 
<div class="master-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'id_product_category')->widget(Select2::classname(), [
            'data' => $listproductcategory,
            'options' => ['placeholder' => 'Product Category'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Product Category');
    ?>

    <?= $form->field($model, 'nama_product')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'photo')->fileInput() ?>
                    
    </tr>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
