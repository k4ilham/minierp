<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;


$this->title = 'Rekap Kehadiran';
$this->params['breadcrumbs'][] = $this->title;

isset($_GET['id']) ? $id = $_GET['id'] : $id="";
isset($_GET['periode']) ? $periode = $_GET['periode'] : $periode="";

$js = <<<js
	$('#mytable2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      "lengthMenu": [ [31,10, 25, 50, 100, 500, 100, -1],[31,10, 25, 50, 100, 500, 1000, "All"] ],
    })

js;
$this->registerJs($js);

?>

<div class="box ">
    <div class="box-header with-border">

    </div>
    <div class="box-body">
       <div class="table-responsive">
        <table class='table table-striped table-hover table-bordered' id='mytable2'>
        <thead>
            <tr>
            <th width="5%" align="center">No</th>
            <th align="center">Tanggal</th>
            <th align="center">Hari</th>
            <th align="center">Nama</th>
            <th align="center">In</th>
            <th align="center">Out</th>
            <th align="center">Status</th>
            <th align="center">Keterangan</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;
        $hadir = 0;
        $libur = 0;
        $alpa = 0;
        $libur_nasional=0;
        $tcuti=0;
        $kosong=0;
        $total=0;
        foreach($model as $row){ 
             
            $id_karyawan=$id;
            $nama = Yii::$app->helperdb->getNamaKaryawan($id_karyawan);
            $cari = Yii::$app->helperdb->dataAbsensibyTgl($id_karyawan,$row['tgl']);
        
            if($cari){
               $in = $cari['in'];
               $out = $cari['out'];
            }else{
                $in = "";
                $out = "";
            }

            //awalnya alpa
            $status= "ALPA";
            $warna="#F1948A";
            //berubah hari libur sabtu minggu
            if($row['hari']==1 || $row['hari']==7){
                $status= "LIBUR"; 
                $warna="#fff5b7";
            }

            //berubah hari libur nasional
            if($row['libur']==1){
                $status= "LIBUR NASIONAL"; 
                $warna="#fff5b7";
            }

            //jika absen lengkap
            if($in != "" && $out != ""){
                $status= "HADIR"; 
                $warna="";
            }

            //jika cuti karyawan pertahun
            $cuti = Yii::$app->helperdb->dataCutiperTahun($id_karyawan);
            if($cuti){
              foreach($cuti as $c){
                $awal = $c['tgl_awal'];
                $akhir = $c['tgl_akhir'];

                $begin = new DateTime($awal);
                $end   = new DateTime($akhir);
                
                for($i = $begin; $i <= $end; $i->modify('+1 day')){
                    $tgl = $i->format("Y-m-d");
                    if($row['tgl']==$tgl){
                        $status= "CUTI"; 
                        $warna="#AED6F1";       
                    }  
                }

                
              }

            }

            //jika tgl > hari ini
            $sekarang = date('Y-m-d');
            if(strtotime($row['tgl']) >= strtotime($sekarang)){
                $status= ""; 
                $warna="";
            }
            $keterangan = $row['keterangan'];

            //hitung jumlah
            if($status==""){
                $kosong = $kosong + 1;
            }

            if($status=="HADIR"){
                $hadir = $hadir + 1;
            }

            if($status=="CUTI"){
                $tcuti = $tcuti + 1;
            }

            if($status=="ALPA"){
                $alpa = $alpa + 1;
            }

            if($status=="LIBUR"){
                $libur = $libur + 1;
            }

            if($status=="LIBUR NASIONAL"){
                $libur_nasional = $libur_nasional + 1;
            }

            $total = $kosong + $hadir + $tcuti + $alpa +  $libur +  $libur_nasional;


            ?>
            <tr>
                <td bgcolor="<?=$warna?>" align="center"><?=$no?></td>
                <td bgcolor="<?=$warna?>"><?=$row['tgl']?></td>
                <td bgcolor="<?=$warna?>"><?=Yii::$app->fungsi->namaHari($row['hari'])?></td>
                <td bgcolor="<?=$warna?>"><?=$nama?></td>
                <td bgcolor="<?=$warna?>"><?=$in?></td>
                <td bgcolor="<?=$warna?>"><?=$out?></td>
                <td bgcolor="<?=$warna?>"><?=$status?></td>
                <td bgcolor="<?=$warna?>"><?=$keterangan?></td>
            </tr>
        <?php $no++; } ?>
        </tbody>
        </table>
        </div>

        <table>
           <tr><td>Total ALPA</td><td>: <?=$alpa?> Hari</td></tr>
           <tr><td>Total Hadir</td><td>: <?=$hadir?> Hari</td></tr>
           <tr><td>Total Cuti</td><td>: <?=$tcuti?> Hari</td></tr>
           <tr><td>Total Libur</td><td>: <?=$libur?> Hari</td></tr>
           <tr><td>Total Libur Nasional</td><td>: <?=$libur_nasional?> Hari</td></tr>
           <tr><td>Undefined</td><td>: <?=$kosong?> Hari</td></tr>
           <tr><td>Total</td><td>: <?=$total?> Hari</td></tr>
        </table>
    </div>
</div>




