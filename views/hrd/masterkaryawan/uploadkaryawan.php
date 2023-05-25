<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;


$this->title = 'Upload Karyawan';
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

    <?= Html::a('Empty Upload', ['deleteuploadkaryawan'],[
                            'class' => 'btn btn-default',
                            'data-toggle'=>"modal",
                            'data-target'=>"#myModal",
                        ]); ?> 

    <?= Html::a('Sinkron Upload', ['sinkronuploadkaryawan'],[
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


            <form method="post" action="<?php echo Url::base().'/masterkaryawan/upload';?>" enctype="multipart/form-data">
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
                    <th align="center">NIK</th>
                    <th align="center">Nama Lengkap</th>
                    <th align="center">aktif</th>
                    <th align="center">id_departemen</th>
                    <th align="center">id_group</th>
                    <th align="center">id_jabatan</th>
                    <th align="center">id_status</th>
                    <th align="center">id_lokasi</th>
                    <th align="center">id_cabang</th>
                    <th align="center">id_jam_kerja</th>
                    <th align="center">jk</th>

                    <th align="center">menikah</th>
                    <th align="center">jml_anak</th>
                    <th align="center">jml_tanggungan</th>
                    <th align="center">ibu_kandung</th>
                    <th align="center">tempat_lahir</th>
                    <th align="center">tgl_lahir</th>
                    <th align="center">tgl_masuk</th>
                    <th align="center">kk</th>
                    <th align="center">ktp</th>
                    <th align="center">alamat_ktp</th>

                    <th align="center">kota</th>
                    <th align="center">alamat_tinggal</th>
                    <th align="center">pendidikan</th>
                    <th align="center">agama</th>
                    <th align="center">goldarah</th>
                    <th align="center">nohp1</th>
                    <th align="center">nohp2</th>
                    <th align="center">email</th>
                    <th align="center">bpjstk</th>
                    <th align="center">bpjskes</th>
                    <th align="center">npwp</th>


  
                    </tr>
                </thead>
                <tbody>
                <?php 
                $no=1;
                foreach($model as $row){ 
                    $warna="";
                    if($row->aktif==0){
                        $warna="grey";
                    }
                    ?>
                    <tr >
                        <td bgcolor="<?=$warna?>" align="center">
                            <?=Html::a("Del", ['deletetemp', 'id' => $row->id_karyawan], ['class' => 'btn btn-danger btn-xs','data-toggle'=>"modal",
                                        'data-target'=>"#myModal",])?>
                        </td>
                        <td bgcolor="<?=$warna?>" align="center"><?=$no?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->nik?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->nama_karyawan ?></td>

                        <td bgcolor="<?=$warna?>"><?=$row->aktif?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->id_departemen?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->id_group?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->id_jabatan?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->id_status?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->id_lokasi?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->id_cabang?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->id_jam_kerja?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->jk?></td>

                        <td bgcolor="<?=$warna?>"><?=$row->menikah?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->jml_anak?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->jml_tanggungan?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->ibu_kandung?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->tempat_lahir?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->tgl_lahir?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->tgl_masuk?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->kk?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->ktp?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->alamat_ktp?></td>

                        <td bgcolor="<?=$warna?>"><?=$row->kota?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->alamat_tinggal?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->pendidikan?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->agama?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->goldarah?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->nohp1?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->nohp2?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->email?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->bpjstk?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->bpjskes?></td>
                        <td bgcolor="<?=$warna?>"><?=$row->npwp?></td>

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






