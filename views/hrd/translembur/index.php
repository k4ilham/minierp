<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal; 
use yii\helpers\Url;


$this->title = 'Lembur';
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
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
        isset($_GET['periode']) ?  $periode = $_GET['periode'] : $periode = $periodeaktif;
    ?>
    
    Periode :
    <?php foreach($list_tahun as $r){ ?>
        <?php if($r['thn'] == $tahun){ ?>
            <a href="<?=Url::base(true);?>/translembur?tahun=<?=$r['thn']?>&periode=<?=$periode?>" type="button" class="btn btn-danger btn-xs" ><?=$r['thn']?></a>
        <?php }else{ ?>
            <a href="<?=Url::base(true);?>/translembur?tahun=<?=$r['thn']?>&periode=<?=$periode?>" type="button" class="btn btn-primary btn-xs" ><?=$r['thn']?></a>
        <?php } ?>
    <?php } ?>

    &nbsp; - &nbsp;
    <?php foreach($list_periode as $r){ ?>
        <?php if($r['periode'] == $periode){ ?>
            <a href="<?=Url::base(true);?>/translembur?tahun=<?=$tahun?>&periode=<?=$r['periode']?>" type="button" class="btn btn-danger btn-xs" ><?=substr($r['periode'],5,6)?></a>
        <?php }else{ ?>
            <a href="<?=Url::base(true);?>/translembur?tahun=<?=$tahun?>&periode=<?=$r['periode']?>" type="button" class="btn btn-primary btn-xs" ><?=substr($r['periode'],5,6)?></a>
        <?php } ?>
    <?php } ?>

    <hr>


<div class="box box-primary box-solid">
    <div class="box-header with-border">
     
    <?= Html::a('Tambah Lembur', ['create'],[
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
            <th align="center">Tgl</th>
            <th align="center">Periode</th>
            <th align="center">JH</th>
            <th align="center">Mulai</th>
            <th align="center">Selesai</th>
            <th align="center">Istirahat</th>
            <th align="center">Jam Lembur</th>
            <th align="center">Rate</th>
            <th align="center">Index</th>
            <th align="center">Uang Lembur</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;
        foreach($model as $row){ ?>
            <tr>
                <td align="center">
                    <?=Html::a("...", ['view', 'id' => $row->id_lembur], ['class' => 'btn btn-primary btn-xs','data-toggle'=>"modal",
                                'data-target'=>"#myModal",])?>
                </td>
                <td align="center"><?=$no?></td>
                <td><?=Yii::$app->helperdb->getNamaKaryawan($row->id_karyawan)?></td>
                <td><?=$row->tgl_lembur?></td>
                <td><?=$row->periode?></td>
                <td><?=$row->jh?></td>
                <td><?=$row->jam_mulai?></td>
                <td><?=$row->jam_selesai?></td>
                <td><?=$row->jam_istirahat?></td>
                <td><?=$row->jam_lembur?></td>
                <td><?=number_format($row->rate,0)?></td>
                <td><?=$row->index_lembur?></td>
                <td><?=number_format($row->uang_lembur,0)?></td>
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



