<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use app\models\hrd\MasterGroup;

$this->title = 'Jam Kerja';
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

<div class="box box-primary box-solid collapsed-box">
    <div class="box-header with-border">
 

      <div class="box-tools pull-right">
      <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button> 
               
      </div>
    </div>
    <div class="box-body" style="display: none;">
        <table class='table table-striped table-hover table-bordered' id='mytable'>
        <thead>
            <tr>
            <th width="5%" align="center">Menu</th>
            <th width="5%" align="center">No</th>
            <th align="center">NIK</th>
            <th align="center">Nama Lengkap</th>
            <th align="center">Departemen</th>
            <th align="center">Jam Kerja</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;
        foreach($model as $row){ 

            ?>
            <tr>
                <td align="center">
                    <?=Html::a("...", ['updateratejamkerja', 'id' => $row->id_karyawan], ['class' => 'btn btn-primary btn-xs','data-toggle'=>"modal",
                                'data-target'=>"#myModal",])?>
                </td>
                <td align="center"><?=$no?></td>
                <td><?=$row->nik?></td>
                <td><?=$row->nama_karyawan ?></td>
                <td><?=Yii::$app->helperdb->getNamaDepartemen($row->id_departemen)?></td>
                <td><?=Yii::$app->helperdb->getNamaJamKerja($row->id_jam_kerja) ?></td>
            </tr>
        <?php $no++; } ?>
        </tbody>
        </table>
    </div>
</div>

<?php
    $myfilter = MasterGroup::find() 
    ->orderBy(['nama_group' => SORT_ASC])
    ->all(); 
?>

<?php
$n=1;
foreach($myfilter as $rr){ 
?>
        <div class="box box-primary box-solid">
            <div class="box-header with-border">

            <?php
                    $idfilter = $rr->id_group;
                    $namafilter = $rr->nama_group;   
                    $query="SELECT *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja from master_karyawan
                            WHERE aktif=1 and id_group='$idfilter'
                            order by id_karyawan asc;";
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();   
                    $jmlfilter = count($karyawan); 
            ?>
               <?=$n?>. &nbsp;<?=$namafilter?> ( <?=$jmlfilter?> )  
               &nbsp;&nbsp;&nbsp; 
               <?= Html::a('Shift 1', ['updatejamkerjamassal','id_group' => $rr->id_group,'id_jam_kerja' => '1'],['class' => 'btn btn-default']); ?> 
               <?= Html::a('Shift 2', ['updatejamkerjamassal','id_group' => $rr->id_group,'id_jam_kerja' => '2'],['class' => 'btn btn-default']); ?>   
               <?= Html::a('Shift 3', ['updatejamkerjamassal','id_group' => $rr->id_group,'id_jam_kerja' => '3'],['class' => 'btn btn-default']); ?> 

               <?= Html::a('Office 1', ['updatejamkerjamassal','id_group' => $rr->id_group,'id_jam_kerja' => '4'],['class' => 'btn btn-default']); ?> 
               <?= Html::a('Office 2', ['updatejamkerjamassal','id_group' => $rr->id_group,'id_jam_kerja' => '5'],['class' => 'btn btn-default']); ?>  

            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
            </div>
            <div class="box-body" >
                <div class="table-responsive">
                <table class='table table-striped table-hover table-bordered' id="table<?=$n?>">
                <thead>
                    <tr>
                    <th width="5%" align="center">Menu</th>
                    <th width="5%" align="center">No</th>
                    <th align="center">NIK</th>
                    <th align="center">Nama Lengkap</th>
                    <th align="center">Departemen</th>
                    <th align="center">Jam Kerja</th>
                    </tr>
                </thead>
                <tbody>
                <?php 


                

                $no=1;
                foreach($karyawan as $row){ 
                    $warna="";
                    if($row['aktif']==0){
                        $warna="grey";
                    }
                    ?>
                    <tr >
                        <td bgcolor="<?=$warna?>" align="center">
                            <?=Html::a("...", ['updateratejamkerja', 'id' => $row['id_karyawan']], ['class' => 'btn btn-primary btn-xs','data-toggle'=>"modal",
                                        'data-target'=>"#myModal",])?>
                        </td>
                        <td bgcolor="<?=$warna?>" align="center"><?=$no?></td>
                        <td bgcolor="<?=$warna?>"><?=$row['nik']?></td>
                        <td bgcolor="<?=$warna?>"><?=$row['nama_karyawan'] ?></td>
                        <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->getNamaDepartemen($row['id_departemen'])?></td>
                        <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->getNamaJamKerja($row['id_jam_kerja']) ?></td>
            
                    </tr>
                <?php $no++; } ?>
                </tbody>
                </table>
                </div>
            </div>
        </div>


<?php
  $n++;
    }
?>


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



