<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;

$js = <<<js
	$('#mytable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      "lengthMenu": [ [10, 25, 50, 100, 500, 100, -1],[10, 25, 50, 100, 500, 1000, "All"] ],
    })

    $("#myModal").on("shown.bs.modal", function (event) {
        var button = $(event.relatedTarget)
        var href = button.attr("href")
        $.pjax.reload("#pjax-modal",{
            "timeout":false,
            "url": href, 
            "replace": false,
        });
    })

js;
$this->registerJs($js);

?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]) ?>

<div class="box box-primary box-solid">
    <div class="box-header with-border">
 
      <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
      </div>
    </div>
    <div class="box-body">
        <table class='table table-striped table-hover table-bordered' id='xmytable'>
        <thead>
            <tr>
            <th width="15%" align="center"></th>
            <th align="left"></th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;
         ?>
            <tr>
                <td align="left">Photo</td>
                <td align="left">
                <?php
                    echo Html::img(Url::base(true).'/file/uploads/user/'.$model->photo,[
                        'class'=>'img-thumbnail','style'=>'float:right;','height'=>200,'width'=>200
                    ]); 
                  ?>
                  <?= $form->field($model, 'photo')->fileInput() ?>
                  
                
                  <div class="form-group">
                    <?= Html::submitButton('Update Photo', ['class' => 'btn btn-primary']) ?>
                  </div>

                </td>
            </tr>
            <tr>
                <td align="left">Username</td>
                <td align="left"><?=$model->username?></td>
            </tr>
            <tr>
                <td align="left">Email</td>
                <td align="left"><?=$model->email?></td>
            </tr>
            <tr>
                <td align="left">Ganti Password</td>
                <td align="left">
                <a href="<?=Url::base(true)?>/transuser/gantipass">Ganti Password</a>
                </td>
            </tr>

            
        </tbody>
        </table>
    </div>
</div>









<?php
ActiveForm::end();
    Modal::begin([
        'id' => 'myModal',
    ]);
        Pjax::begin([
            'id'=>'pjax-modal','timeout'=>false,
            'enablePushState'=>false,
            'enableReplaceState'=>false,
        ]);
        Pjax::end();
    Modal::end();
?>



