<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'HRIS Login IJMS';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4"><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to login:</p>
</div>

<?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-12 control-label'],
        ],
    ]); ?>

        <div class="form-group">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control form-control-user']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control form-control-user']) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'login-button']) ?>
        </div>
        

<?php ActiveForm::end(); ?>