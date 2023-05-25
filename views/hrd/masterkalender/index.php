<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;


$this->title = 'Master Kalender';
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

    <?php
        isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
        isset($_GET['bulan']) ?  $bulan = $_GET['bulan'] : $bulan = date('m');
    ?>
    
    Tahun :
    <?php foreach($list_tahun as $r){ ?>
        <?php if($r['thn'] == $tahun){ ?>
            <a href="masterkalender?tahun=<?=$r['thn']?>&bulan=<?=$bulan?>" type="button" class="btn btn-danger btn-xs" ><?=$r['thn']?></a>
        <?php }else{ ?>
            <a href="masterkalender?tahun=<?=$r['thn']?>&bulan=<?=$bulan?>" type="button" class="btn btn-primary btn-xs" ><?=$r['thn']?></a>
        <?php } ?>
    <?php } ?>

    &nbsp;&nbsp;&nbsp;

    Bulan :
    <?php foreach($list_bulan as $r){ ?>
        <?php if($r['bln'] == $bulan){ ?>
            <a href="masterkalender?tahun=<?=$tahun?>&bulan=<?=$r['bln']?>" type="button" class="btn btn-danger btn-xs" ><?=$r['bln']?></a>
        <?php }else{ ?>
            <a href="masterkalender?tahun=<?=$tahun?>&bulan=<?=$r['bln']?>" type="button" class="btn btn-primary btn-xs" ><?=$r['bln']?></a>
        <?php } ?>
    <?php } ?>

    <hr>


<div class="box box-primary box-solid">
    <div class="box-header with-border">
     
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
            <th align="center">Tanggal</th>
            <th align="center">Hari</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;
        foreach($model as $row){ ?>
            <tr>
                <td align="center">
                    <?=Html::a("...", ['view', 'id' => $row->id_kalender], ['class' => 'btn btn-primary btn-xs','data-toggle'=>"modal",
                                'data-target'=>"#myModal",])?>
                </td>
                <td align="center"><?=$no?></td>
                <td><?=$row->tgl?></td>
                <td><?php echo Yii::$app->fungsi->getHari($row->hari); ?></td>
            </tr>
        <?php $no++; } ?>
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



