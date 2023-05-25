<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransGajiPokok */

$this->title = $model->id_karyawan;
$this->params['breadcrumbs'][] = ['label' => 'Bank', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$kar = Yii::$app->helperdb->getKaryawan($model->id_karyawan);
if($kar){
    $nik = $kar['nik'];
    $nama_karyawan = $kar['nama_karyawan'];
    $tgl_masuk = $kar['tgl_masuk'];
    $norek = $kar['norek'];
    $id_departemen = $kar['id_departemen'];
    $departemen = Yii::$app->helperdb->getNamaDepartemen($id_departemen);
}else{
    $nik = "";
    $nama_karyawan = "";
    $tgl_masuk = "";
    $norek = "";
    $id_departemen = "";
    $departemen = "";
}

?>
<div class="trans-gaji-pokok-view">

<table>
    <thead>
    </thead>
    <tbody>


        <tr>
            <td colspan="3"><img src="<?=Url::base()?>/file/logoijms.png" width="200px" height="auto"></td>
            <td colspan="2"></td>

            <td>&nbsp;&nbsp;</td>
            

            <td>Nama</td>
            <td colspan="2">: <?=$nama_karyawan?></td>
        </tr>

        <tr>
            <td colspan="3">Nik PT</td>
            <td colspan="2">: <?=$nik?></td>

            <td></td>
            

            <td>No rek BCA</td>
            <td colspan="2">: <?=$model->norek?></td>
        </tr>

        <tr>
            <td colspan="3">Masuk kerja</td>
            <td colspan="2">: <?=$tgl_masuk?></td>

            <td></td>
            

            <td>Bagian</td>
            <td colspan="2">: <?=$departemen?></td>
        </tr>

        <tr>
            <td colspan="3"> </td>
            <td colspan="2"></td>

            <td></td>
            

            <td>Gaji Bulan</td>
            <td colspan="2">: <?=$model->periode?></td>
        </tr>

        <tr>
            <td colspan="9"><hr> </td>
        </tr>



        <tr>
            <td>Gaji Pokok</td>
            <td></td>
            <td></td>
            <td>: <?=number_format($model->gapok,0)?></td>

            <td></td>

            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>T Jabatan</td>
            <td></td>
            <td></td>
            <td>: <?=number_format($model->tunj_jabatan,0)?></td>

            <td></td>

            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>T Keahlian</td>
            <td></td>
            <td></td>
            <td>:  <u><?=number_format($model->tunj_keahlian,0)?></u></td>

            <td></td>

            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        
        <?php
          $total1 = $model->gapok + $model->tunj_jabatan + $model->tunj_keahlian; 
        ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Total 1</td>
            <td>:  <u><?=number_format($total1,0)?></u></td>

            <td></td>

            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>T Masa Kerja</td>
            <td></td>
            <td></td>
            <td>: <?=number_format($model->tunj_masakerja,0)?></td>

            <td></td>

            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>T Lain-lain</td>
            <td></td>
            <td></td>
            <td>: <?=number_format($model->tunj_lain,0)?></td>

            <td></td>

            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>Uang Kehadiran</td>
            <td></td>
            <td></td>
            <td>: <?=number_format($model->uang_kehadiran,0)?></td>
            <td></td>

            <td></td>

            <td>BPJS Kesehatan </td>
            <td>(1%)</td>
            <td>: <?=number_format($model->bpjskes,0)?></td>
        </tr>

        <tr>
            <td>Insentif  kedisiplinan</td>
            <td></td>
            <td></td>
            <td>: <?=number_format(0,0)?></td>
            <td></td>
            
            <td></td>

            <td>Iuran Pensiun </td>
            <td>(1%)</td>
            <td>: <?=number_format($model->pensiun,0)?></td>
        </tr>

        <tr>
            <td>Lembur</td>
            <td></td>
            <td></td>
            <td>: <?=number_format($model->uang_lembur,0)?></td>
            <td></td>
            
            <td></td>

            <td>Jaminan Hari Tua </td>
            <td>(2%)</td>
            <td>: <?=number_format($model->bpjstk,0)?></td>
        </tr>

        <tr>
            <td>Lain – Lain</td>
            <td></td>
            <td></td>
            <td>:  <u><?=number_format(0,0)?></u></td>
            <td></td>
            
            <td></td>

            <td>Potongan kedisiplinan</td>
            <td></td>
            <td>: <?=number_format($model->pot_kedisplinan,0)?></td>
        </tr>

        <?php
          $total2 = $model->tunj_masakerja + $model->tunj_lain + $model->uang_kehadiran + 0 + $model->uang_lembur;  
        ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Total 2</td>
            <td>:  <u><?=number_format($total2,0)?></u></td>

            <td></td>

            <td>Potongan lain lain</td>
            <td></td>
            <td>: <?=number_format($model->pot_lain,0)?></td>
        </tr>

        <?php
          $pendapatan = $total1 + $total2;
          $potongan = $model->bpjskes + $model->pensiun + $model->bpjstk + $model->pot_kedisplinan + $model->pot_lain;
        ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Jumlah  Pendapatan</td>
            <td>:<u>  <?=number_format($pendapatan,0)?></u></td>

            <td></td>

            <td>Jumlah Potongan</td>
            <td></td>
            <td>: <u> <?=number_format($potongan,0)?></u></td>
        </tr>

        <?php
          $gaji = $pendapatan - $potongan;
        ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

            <td></td>

            <td><b>Gaji yg diterima</b></td>
            <td></td>
            <td>: <b><?=number_format($gaji,0)?></b></td>
        </tr>
    </tbody>
</table>


</div>
