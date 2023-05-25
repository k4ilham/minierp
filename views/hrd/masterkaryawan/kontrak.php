<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->title = 'Kontrak';
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
        <table class='table table-striped table-hover table-bordered' id='mytable'>
        <thead>
            <tr>
            <th width="5%" align="center">Menu</th>
            <th width="5%" align="center">No</th>
            <th align="center">NIK</th>
            <th align="center">Nama Lengkap</th>
            <th align="center">Departemen</th>
            <th align="center">Status</th>
            <th align="center">Tgl Bergabung</th>
            <th align="center">Lama Kerja (Tahun)</th>
            <th align="center">Periode Kontrak</th>
            <th align="center">Lama Kontrak (Bulan)</th>
            <th align="center">Mulai Kontrak</th>
            <th align="center">Akhir Kontrak</th>
            <th align="center">Sisa Kontrak</th>
            
            </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;
        foreach($model as $row){ 
            
            //habis kontrak
            if($row->akhir_kontrak!=""){
                $sekarang = date('Y-m-d');
                $akhir = date('Y-m-d',strtotime($row->akhir_kontrak));
                $diff     = strtotime($akhir) - strtotime($sekarang);
                $sisa=round($diff/3600/24,0);;
            }else{
                $sisa = "";
            }

            //lama kerja
            if($row->tgl_masuk!=""){
                $sekarang = date('Y-m-d');
                $masuk = date('Y-m-d',strtotime($row->tgl_masuk));
                $diff     = strtotime($sekarang) - strtotime($masuk);
                $lama=round($diff/3600/24/365,2);;
            }else{
                $lama = "";
            }

 
            ?>
            <tr>
                <td align="center">
                    <?=Html::a("...", ['viewkontrak', 'id' => $row->id_karyawan], ['class' => 'btn btn-primary btn-xs','data-toggle'=>"modal",
                                'data-target'=>"#myModal",])?>
                </td>
                <td align="center"><?=$no?></td>
                <td><?=$row->nik?></td>
                <td><?=$row->nama_karyawan ?></td>
                <td><?=Yii::$app->helperdb->getNamaDepartemen($row->id_departemen)?></td>
                <td><?=Yii::$app->helperdb->getNamaStatus($row->id_status)?></td>
                <td><?=$row->tgl_masuk?></td>
                <td><?=$lama?></td>
                <td><?=$row->periode_kontrak?></td>
                <td><?=$row->bulan_kontrak?></td>
                <td><?=$row->mulai_kontrak?></td>
                <td><?=$row->akhir_kontrak?></td>
                <td><?=$sisa?></td>
                
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



