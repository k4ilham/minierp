<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal; 
use yii\helpers\Url;


$this->title = 'History Gaji';
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

js;
$this->registerJs($js);

$detail= 0;


?>

<?php
        $periodeaktif = Yii::$app->helperdb->periodeAktif();
        isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
        isset($_GET['periode']) ?  $periode = $_GET['periode'] : $periode = $periodeaktif;
    ?>
    
    Periode :
    <?php foreach($list_tahun as $r){ ?>
        <?php if($r['thn'] == $tahun){ ?>
            <a href="<?=Url::base(true);?>/transgajihistory?tahun=<?=$r['thn']?>&periode=<?=$periode?>" type="button" class="btn btn-danger btn-xs" ><?=$r['thn']?></a>
        <?php }else{ ?>
            <a href="<?=Url::base(true);?>/transgajihistory?tahun=<?=$r['thn']?>&periode=<?=$periode?>" type="button" class="btn btn-primary btn-xs" ><?=$r['thn']?></a>
        <?php } ?>
    <?php } ?>

    &nbsp; - &nbsp;
    <?php foreach($list_periode as $r){ ?>
        <?php if($r['periode'] == $periode){ ?>
            <a href="<?=Url::base(true);?>/transgajihistory?tahun=<?=$tahun?>&periode=<?=$r['periode']?>" type="button" class="btn btn-danger btn-xs" ><?=substr($r['periode'],5,6)?></a>
        <?php }else{ ?>
            <a href="<?=Url::base(true);?>/transgajihistory?tahun=<?=$tahun?>&periode=<?=$r['periode']?>" type="button" class="btn btn-primary btn-xs" ><?=substr($r['periode'],5,6)?></a>
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


    <div class="table-responsive">

        <table class='table  table-striped table-hover table-bordered' id='mytable'>
        <thead>
            <tr>
            <th width="5%" align="center">No</th>
            <th align="center">Periode</th>
            <th align="center">NIK</th>
            <th align="center">Nama</th>
            <th align="center">Gaji <br> Pokok</th>
            
            

            <?php if($detail==1){ ?>
                <th align="center">Kehadiran</th>
                <th align="center">Lembur</th>

                <th align="center">Tunjangan <br> Masa Kerja</th>
                <th align="center">Tunjangan <br> Jabatan</th>
                <th align="center">Tunjangan <br> Keahlian</th>
                <th align="center">Tunjangan <br> Lain</th>

                <th align="center">Potongan <br> Kedisplinan</th>
                <th align="center">Potongan <br> Lain</th>

                <th align="center">BPJS <br> Kesehatan</th>
                <th align="center">BPJS <br> TK</th>
                <th align="center">Iuran <br> Pensiun</th>
            <?php } ?>

            <th align="center">Total 1</th>
            <th align="center">Total 2</th>

            <th align="center">Total <br> Pendapatan</th>
            <th align="center">Total <br> Potongan</th>
            <th align="center">Gaji <br> Bersih</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;
        $total_gapok=0;
        $total_uang_kehadiran=0;
        $total_uang_lembur=0;
        $total_tunj_masakerja=0;
        $total_tunj_jabatan=0;
        $total_tunj_keahlian=0;
        $total_tunj_lain=0;
        $total_pot_kedisplinan=0;
        $total_pot_lain=0;
        $total_total1=0;
        $total_total2=0;
        $total_total_pendapatan=0;
        $total_total_potongan=0;
        $total_gaji_bersih=0;
        $total_bpjskes=0;
        $total_bpjstk=0;
        $total_pensiun=0;
        foreach($model as $row){ 
              
               $kar = Yii::$app->helperdb->getKaryawan($row->id_karyawan);
               if($kar){
                   $nik = $kar['nik'];
                   $nama = $kar['nama_karyawan'];
               }else{
                   $nik = "";
                   $nama = "";
               }
            ?>
            <tr>

                <td align="center"><?=$no?></td>
                <td align="center"><?=$row->periode?></td>
                <td align="center"><?=$nik?></td>
                <td align="left">
                <?=Html::a($nama, ['view', 'id' => $row->id_gaji], ['data-toggle'=>"modal",
                                'data-target'=>"#myModal",])?>
                </td>
                <td align="left"><?=number_format($row->gapok,0)?></td>
                
                
                <?php if($detail==1){ ?>
                    <td align="left"><?=number_format($row->uang_kehadiran,0)?></td>
                    <td align="left"><?=number_format($row->uang_lembur,0)?></td>

                    <td align="left"><?=number_format($row->tunj_masakerja,0)?></td>
                    <td align="left"><?=number_format($row->tunj_jabatan,0)?></td>
                    <td align="left"><?=number_format($row->tunj_keahlian,0)?></td>
                    <td align="left"><?=number_format($row->tunj_lain,0)?></td>

                    <td align="left"><?=number_format($row->pot_kedisplinan,0)?></td>
                    <td align="left"><?=number_format($row->pot_lain,0)?></td>

                    <td align="left"><?=number_format($row->bpjskes,0)?></td>
                    <td align="left"><?=number_format($row->bpjstk,0)?></td>
                    <td align="left"><?=number_format($row->pensiun,0)?></td>
                <?php } ?>
                
                <td align="left"><?=number_format($row->total1,0)?></td>
                <td align="left"><?=number_format($row->total2,0)?></td>
                <td align="left"><?=number_format($row->total_pendapatan,0)?></td>
                <td align="left"><?=number_format($row->total_potongan,0)?></td>
                <td align="left"><?=number_format($row->gaji_bersih,0)?></td>

            </tr>
        <?php 
           $no++; 
           $total_gapok = $total_gapok + $row->gapok;
           $total_uang_kehadiran=$total_uang_kehadiran+$row->uang_kehadiran;
           $total_uang_lembur=$total_uang_lembur+$row->uang_lembur;

           $total_tunj_masakerja=$total_tunj_masakerja+$row->tunj_masakerja;
           $total_tunj_jabatan=$total_tunj_jabatan+$row->tunj_jabatan;
           $total_tunj_keahlian=$total_tunj_keahlian+$row->tunj_keahlian;
           $total_tunj_lain=$total_tunj_lain+$row->tunj_lain;

           $total_pot_kedisplinan=$total_pot_kedisplinan+$row->pot_kedisplinan;
           $total_pot_lain=$total_pot_lain+$row->pot_lain;

           $total_bpjskes = $total_bpjskes + $row->bpjskes;
           $total_bpjstk = $total_bpjstk + $row->bpjstk;
           $total_pensiun = $total_pensiun + $row->pensiun;

           $total_total1=$total_total1+$row->total1;
           $total_total2=$total_total2+$row->total2;


           $total_total_pendapatan=$total_total_pendapatan+$row->total_pendapatan;
           $total_total_potongan=$total_total_potongan+$row->total_potongan;
           $total_gaji_bersih=$total_gaji_bersih+$row->gaji_bersih;        
        } ?>
        </tbody>
        <tfoot>
            <tr>
            <th width="5%" align="center">No</th>
            <th align="center">Periode</th>
            <th align="center">NIK</th>
            <th align="center">Karyawan</th>
            <th align="center"><?=number_format($total_gapok,0)?></th>
            
            
            <?php if($detail==1){ ?>

                <th align="center"><?=number_format($total_uang_kehadiran,0)?></th>
                <th align="center"><?=number_format($total_uang_lembur,0)?></th>

                <th align="center"><?=number_format($total_tunj_masakerja,0)?></th>
                <th align="center"><?=number_format($total_tunj_jabatan,0)?></th>
                <th align="center"><?=number_format($total_tunj_keahlian,0)?></th>
                <th align="center"><?=number_format($total_tunj_lain,0)?></th>

                <th align="center"><?=number_format($total_pot_kedisplinan,0)?></th>
                <th align="center"><?=number_format($total_pot_lain,0)?></th>

                <th align="center"><?=number_format($total_bpjskes,0)?></th>
                <th align="center"><?=number_format($total_bpjstk,0)?></th>
                <th align="center"><?=number_format($total_pensiun,0)?></th>
            <?php } ?>

            <th align="center"><?=number_format($total_total1,0)?></th>
            <th align="center"><?=number_format($total_total2,0)?></th>

            <th align="center"><?=number_format($total_total_pendapatan,0)?></th>
            <th align="center"><?=number_format($total_total_potongan,0)?></th>
            <th align="center"><?=number_format($total_gaji_bersih,0)?></th>
            </tr>
        </tfoot>
        <tbody>
        </table>
    </div>
    </div>
</div>

<?php
    Modal::begin([
        'header'=>'<img src="'.Url::base().'/file/logoijms.png" width="200px" height="auto">',
        'id' => 'myModal',
        'size'=>'modal-lg',
    ]);
        Pjax::begin([
            'id'=>'pjax-modal','timeout'=>false,
            'enablePushState'=>false,
            'enableReplaceState'=>false,
        ]);
        Pjax::end();
    Modal::end();
?>



