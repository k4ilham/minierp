<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal; 
use yii\helpers\Url;


$this->title = 'Absensi Koreksi';
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


//var_dump(Yii::$app->helperdb->dataCutiperTahun(73));

?>

    <?php
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
        isset($_GET['periode']) ?  $periode = $_GET['periode'] : $periode = $periodeaktif;
    ?>
    
    Periode :
    <?php foreach($list_tahun as $r){ ?>
        <?php if($r['thn'] == $tahun){ ?>
            <a href="<?=Url::base(true);?>/transabsensikoreksi?tahun=<?=$r['thn']?>&periode=<?=$periode?>" type="button" class="btn btn-danger btn-xs" ><?=$r['thn']?></a>
        <?php }else{ ?>
            <a href="<?=Url::base(true);?>/transabsensikoreksi?tahun=<?=$r['thn']?>&periode=<?=$periode?>" type="button" class="btn btn-primary btn-xs" ><?=$r['thn']?></a>
        <?php } ?>
    <?php } ?>

    &nbsp; - &nbsp;
    <?php foreach($list_periode as $r){ ?>
        <?php if($r['periode'] == $periode){ ?>
            <a href="<?=Url::base(true);?>/transabsensikoreksi?tahun=<?=$tahun?>&periode=<?=$r['periode']?>" type="button" class="btn btn-danger btn-xs" ><?=substr($r['periode'],5,6)?></a>
        <?php }else{ ?>
            <a href="<?=Url::base(true);?>/transabsensikoreksi?tahun=<?=$tahun?>&periode=<?=$r['periode']?>" type="button" class="btn btn-primary btn-xs" ><?=substr($r['periode'],5,6)?></a>
        <?php } ?>
    <?php } ?>

    <hr>


<div class="box box-primary box-solid">
    <div class="box-header with-border">
     
    <?= Html::a('Tambah Absen Koreksi', ['create'],[
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
            <th align="center">Karyawan</th>
            <th align="center">Periode</th>
            <th align="center">Tgl</th>
            <th align="center">In</th>
            <th align="center">Out</th>
            <th align="left">Keterangan</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;
        foreach($model as $row){ ?>
            <tr>
                <td align="center">
                    <?=Html::a("...", ['view', 'id' => $row->id_absensi_koreksi], ['class' => 'btn btn-primary btn-xs','data-toggle'=>"modal",
                                'data-target'=>"#myModal",])?>
                </td>
                <td align="center"><?=$no?></td>
                <td><?=Yii::$app->helperdb->getNamaKaryawan($row->id_karyawan)?></td>
                <td><?=$row->periode?></td>
                <td><?=$row->tgl_absen?></td>
                <td><?=$row->in?></td>
                <td><?=$row->out?></td>
                <td><?=$row->keterangan?></td>
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



