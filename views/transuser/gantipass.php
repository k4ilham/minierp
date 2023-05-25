<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


$this->title = 'Ganti Password';
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


<div class="box box-primary box-solid">
    <div class="box-header with-border">
 
      <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
      </div>
    </div>
    <div class="box-body">
    <form method="post" action="<?php echo Url::base().'/transuser/gantipass';?>">
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
            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()); ?>
            <input type="hidden" value="<?=$model->id?>" name="iduser" class="form-control">
            <tr>
                <td align="left">Username</td>
                <td align="left"><?=$model->username?></td>
            </tr>
            <tr>
                <td align="left">Email</td>
                <td align="left"><?=$model->email?></td>
            </tr>
            


            <tr>
                <td align="left">Password Lama</td>
                <td align="left"><input type="password" name="passlama" class="form-control" required></td>
            </tr> 

            <tr>
                <td align="left">Password Baru</td>
                <td align="left"><input type="password" name="passbaru" class="form-control" required></td>
            </tr>

            <tr>
                <td align="left"></td>
                <td align="left"><?= Html::submitButton('Update Password', ['class' => 'btn btn-primary']) ?></td>
            </tr>
            
        </tbody>
        </table>
        </form>
    </div>
</div>









<?php
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



