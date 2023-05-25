<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;


$this->title = 'Upload Absen';
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
     
    <?= Html::a('Empty Upload', ['deleteuploadabsensi'],[
                            'class' => 'btn btn-default',
                            'data-toggle'=>"modal",
                            'data-target'=>"#myModal",
                        ]); ?> 

<?= Html::a('Sinkron Upload', ['sinkronuploadabsensi'],[
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


            <form method="post" action="<?php echo Url::base().'/transabsensi/upload';?>" enctype="multipart/form-data">
               <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()); ?>
               <div class="form-group">
                    ** Pastikan file yang diupload berupa file csv, xls atau xlsx<br><br>
                        <div class="form-group">
                            <label for="exampleInputFile">File Upload</label>
                            <input type="file" name="berkas_excel" class="form-control" id="exampleInputFile" required>
                        </div>
							
			  </div>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> UPLOAD</button>
            </form>


<hr>


<div class="table-responsive">
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
        </tr>
    </thead>
    <tbody>
    <?php 
    $no=1;
    foreach($model as $row){ 
        $warna="";

        ?>
        <tr >
            <td bgcolor="<?=$warna?>" align="center">
                <?=Html::a("Del", ['deletetemp', 'id' => $row->id_absensi], ['class' => 'btn btn-danger btn-xs','data-toggle'=>"modal",
                            'data-target'=>"#myModal",])?>
            </td>
            <td bgcolor="<?=$warna?>" align="center"><?=$no?></td>
            <td bgcolor="<?=$warna?>" align="left"><?=Yii::$app->helperdb->getNamaKaryawan($row->id_karyawan)?></td>
            <td bgcolor="<?=$warna?>" align="center"><?=$row->periode?></td>
            <td bgcolor="<?=$warna?>" align="center"><?=$row->tgl_absen?></td>
            <td bgcolor="<?=$warna?>" align="center"><?=$row->in?></td>
            <td bgcolor="<?=$warna?>" align="center"><?=$row->out?></td>

        </tr>
    <?php $no++; } ?>
    </tbody>
    </table>
</div>


</div>

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




