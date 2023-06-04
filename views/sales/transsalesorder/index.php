<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = 'Sales Order';
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
      "order": [[1, "asc"]]
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
 
        <?= Html::a('Tambah Sales Order', ['create'],[
                            'class' => 'btn btn-default',
                            'data-toggle'=>"modal",
                            'data-target'=>"#myModal",
                        ]); ?>

      <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
      </div>
    </div>
    <div class="box-body">
        <table class='table table-striped table-hover table-bordered' id='mytable'>
        <thead>
            <tr>
                <th width="5%" align="center">Menu</th>
                <th width="5%" align="center">No</th>
                <th width="10%" align="center">Kode</th>
                <th width="5%" align="center">Qty</th>
                <th width="5%" align="center">Total</th>
                <th width="5%" align="center">Status</th>
                <th align="center">Customer</th>
                <th align="center">Sales Person</th>

                <th align="center">Ext Doc</th>      
                <th align="center">Order Date</th>
                <th align="center">Doc Date</th>
            </tr> 
        </thead>
        <tbody>
        <?php 
        $no=1;
        $t_qty = 0;
        $t_subtotal = 0;
        foreach($model as $row){ 
              $status = Yii::$app->helperdb->getStatus($row->status);
              $color_status = Yii::$app->helperdb->getStatusColor($row->status);
              $qty = Yii::$app->helperdb->sumTotalSalesOrder($row->id_sales_order_header,"qty");
              $subtotal = Yii::$app->helperdb->sumTotalSalesOrder($row->id_sales_order_header,"subtotal");
              $nama_customer = Yii::$app->helperdb->getField("master_customer","id_customer","nama_customer",$row->id_customer);
              $sales_person = Yii::$app->helperdb->getField("master_karyawan","id_karyawan","nama_karyawan",$row->sales_person_code);
            ?>
            <tr>
                <td bgcolor="<?=$color_status?>" align="center">
                    <?=Html::a("...", ['view', 'id' => $row->id_sales_order_header], ['class' => 'btn btn-primary btn-xs','data-toggle'=>"modal",
                                'data-target'=>"#myModal",])?>
                </td>
                <td bgcolor="<?=$color_status?>" align="center"><?=$no?></td>
                <td bgcolor="<?=$color_status?>" align="center">
                <?php if($row->status==0){ ?>
                    <a href="<?=Url::base(true)?>/sales/transsalesorder/detail?id=<?=$row->id_sales_order_header?>">
                    <?=$row->kode_sales_order?></a>
                <?php }else{ ?>
                    <?=$row->kode_sales_order?>
                <?php } ?>

                </td>
                <td bgcolor="<?=$color_status?>" align="center"><?=Yii::$app->fungsi->formatUang($qty)?></td>
                <td bgcolor="<?=$color_status?>" align="right"><?=Yii::$app->fungsi->formatUang($subtotal)?></td>
               
                <td bgcolor="<?=$color_status?>" align="center"><?=$status?></td>
                <td bgcolor="<?=$color_status?>" align="left"><?=$nama_customer?></td>
                <td bgcolor="<?=$color_status?>" align="left"><?=$sales_person?></td>

                <td bgcolor="<?=$color_status?>" align="left"><?=$row->ext_doc_no?></td>             
                <td bgcolor="<?=$color_status?>" align="center"><?=$row->order_date?></td>
                <td bgcolor="<?=$color_status?>" align="center"><?=$row->document_date?></td>
                
            </tr>

            <?php 
                $no++; 
                $t_qty = $t_qty + $qty;
                $t_subtotal = $t_subtotal + $subtotal;
              
            } 
        ?>
            <tr>
                <td bgcolor="<?=$color_status?>" align="center">

                </td>
                <td bgcolor="<?=$color_status?>" align="center"><?=$no?></td>
                <td bgcolor="<?=$color_status?>" align="left"><b>TOTAL</b></td>
                <td bgcolor="<?=$color_status?>" align="center"><?=Yii::$app->fungsi->formatUang($t_qty)?></td>
                <td bgcolor="<?=$color_status?>" align="right"><?=Yii::$app->fungsi->formatUang($t_subtotal)?></td>
               
                <td bgcolor="<?=$color_status?>" align="center"></td>
                <td bgcolor="<?=$color_status?>" align="left"></td>
                <td bgcolor="<?=$color_status?>" align="left"></td>

                <td bgcolor="<?=$color_status?>" align="left"></td>             
                <td bgcolor="<?=$color_status?>" align="center"></td>
                <td bgcolor="<?=$color_status?>" align="center"></td>
                
            </tr>
        </tbody>
        </table>
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



