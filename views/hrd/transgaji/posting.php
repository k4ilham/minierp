<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal; 
use yii\helpers\Url;


$this->title = 'Posting Periode :'.Yii::$app->helperdb->periodeAktif();
$this->params['breadcrumbs'][] = $this->title;

$js = <<<js
	$('#mytable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      "lengthMenu": [ [-1,10, 25, 50, 100, 500, 100, -1],["All",10, 25, 50, 100, 500, 1000, "All"] ],
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

    $('#myModal .close').css('display', 'none');

js;
$this->registerJs($js);

$detail= 0;


?>


<div class="box box-primary box-solid">
    <div class="box-header with-border">

      <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
      </div>
    </div>
    <div class="box-body">

    <div class="table-responsive">
            <?= Html::a('Posting Gaji Periode '.Yii::$app->helperdb->periodeAktif(), ['updategaji'],[
                                    'class' => 'btn btn-default',
                                    // 'data-toggle'=>"modal",
                                    // 'data-target'=>"#myModal",
                                    'data' => [ 'confirm' => 'Yakin Mau Posting Gaji ?', 'method' => 'post', ]
                                ]); ?>


    </div>
    </div>
</div>

<?php
    Modal::begin([
        'header'=>'<h4>Proses Posting ....</h4>',
        'id' => 'myModal',
        'size'=>'modal-lg',
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] 
    ]);
        Pjax::begin([
            'id'=>'pjax-modal','timeout'=>false,
            'enablePushState'=>false,
            'enableReplaceState'=>false,
        ]);
        Pjax::end();
    Modal::end();
?>



