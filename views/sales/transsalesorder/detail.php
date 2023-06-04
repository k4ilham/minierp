<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use Da\QrCode\QrCode;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;


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


/* @var $this yii\web\View */
/* @var $model app\models\hrd\Masterproduct */

$this->title = 'Detail Sales Order';
$this->params['breadcrumbs'][] = ['label' => 'Detail Sales Order', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-trans-sales-order-view">


<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'kode_sales_order', 
        [
            'attribute' => 'status',
            'format' => 'html',
            'value' => function ($model) {
             
                return '<a href="'.Url::base(true).'/sales/transsalesorder">'.Yii::$app->helperdb->getStatus($model->status).'</a>';

            },
        ],
        [
            'attribute' => 'id_customer',
            'format' => 'html',
            'value' => function ($model) {
                return Yii::$app->helperdb->getField("master_customer","id_customer","nama_customer",$model->id_customer);

            },
        ],
        [
            'attribute' => 'sales_person_code',
            'format' => 'html',
            'value' => function ($model) {
                return  Yii::$app->helperdb->getField("master_karyawan","id_karyawan","nama_karyawan",$model->sales_person_code);

            },
        ],



    ],
]) ?>


<div class="box box-primary box-solid">
    <div class="box-header with-border">
 


        <?=Html::a("Tambah Product", ['detailadd', 'id' => $id], 
                    ['class' => 'btn btn-default',
                    'data-toggle'=>"modal",
                    'data-target'=>"#myModal",
                    ])?>

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
            <th  align="left">Product</th>
            <th width="5%" align="center">Qty</th> 
            <th width="10%" align="center">Price</th>
            <th width="10%" align="center">Subtotal</th>
            </tr> 
        </thead>
        <tbody>
        <?php 
        $no=1;
        $t_qty = 0;
        $t_subtotal = 0;
        foreach($detail as $row){ 
              $color_status = '';

              $id_product = $row->id_product;
              $nama_product = Yii::$app->helperdb->getField("master_product","id_product","nama_product",$id_product);
              $qty = $row->qty;
              $price = $row->price;
              $subtotal = $row->subtotal;
            ?>
            <tr>
                <td bgcolor="<?=$color_status?>" align="center">
                </td>
                <td bgcolor="<?=$color_status?>" align="center"><?=$no?></td>
                <td bgcolor="<?=$color_status?>" align="left"><?=$nama_product?></td>
                <td bgcolor="<?=$color_status?>" align="center"><?=Yii::$app->fungsi->formatUang($qty)?></td>
                <td bgcolor="<?=$color_status?>" align="right"><?=Yii::$app->fungsi->formatUang($price)?></td>
                <td bgcolor="<?=$color_status?>" align="right"><?=Yii::$app->fungsi->formatUang($subtotal)?></td>
                
            </tr>
        <?php 
                $no++; 
                $t_qty = $t_qty + $qty;
                $t_subtotal = $t_subtotal + $subtotal;
              
            } 
        ?>
        <tr>
            <td></td>
            <td align="center"><?=$no?></td>
            <td align="left"><b>TOTAL</b></td>
            <td align="center"><b><?=Yii::$app->fungsi->formatUang($t_qty)?></b></td>
            <td align="center"></td>
            <td align="right"><b><?=Yii::$app->fungsi->formatUang($t_subtotal)?></b></td>
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

</div>



