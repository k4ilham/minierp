<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use aryelds\sweetalert\SweetAlert;

$this->title = 'Saldo Cuti';
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
 
      <?= Html::a('Tambah Saldo Cuti Awal Tahun', ['cutiawaltahun'],[
                            'class' => 'btn btn-default',
                            // 'data-toggle'=>"modal",
                            // 'data-target'=>"#myModal",
                            'data' => [ 'confirm' => 'Yakin Mau Tambah Saldo Cuti Awal Tahun ?', 'method' => 'post', ]
                        ]); ?>

        <?= Html::a('Reset Saldo Cuti Tahun Lalu', ['resetcutitahunlalu'],[
                            'class' => 'btn btn-default',
                            // 'data-toggle'=>"modal",
                            // 'data-target'=>"#myModal",
                            'data' => [ 'confirm' => 'Yakin Mau Reset Cuti Tahun Lalu ?', 'method' => 'post', ]
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
            <th align="center">NIK</th>
            <th align="center">Nama Lengkap</th>
            <th align="center">Departemen</th>
            <th align="center">Status</th>
            <th align="center">Saldo Tahun Lalu</th>
            <th align="center">Saldo Tahun Ini</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;
        foreach($model as $row){ 

            ?>
            <tr>
                <td align="center">
                    <?=Html::a("...", ['updatecuti', 'id' => $row->id_karyawan], ['class' => 'btn btn-primary btn-xs','data-toggle'=>"modal",
                                'data-target'=>"#myModal",])?>
                </td>
                <td align="center"><?=$no?></td>
                <td><?=$row->nik?></td>
                <td><?=$row->nama_karyawan ?></td>
                <td><?=Yii::$app->helperdb->getNamaDepartemen($row->id_departemen)?></td>
                <td><?=Yii::$app->helperdb->getNamaStatus($row->id_status)?></td>
                
                <td><?=$row->saldo_cuti_lalu ?></td>
                <td><?=$row->saldo_cuti ?></td>
                
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



