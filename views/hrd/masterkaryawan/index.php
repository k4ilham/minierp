<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use app\models\hrd\MasterKaryawan;
use \onmotion\apexcharts\ApexchartsWidget;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;


$this->title = 'Karyawan';
$this->params['breadcrumbs'][] = $this->title;

$js = <<<js
	$('#mytable,#table1,#table2,#table3,#table4,#table5,#table6,#table7,#table8,#table9,#table10,#table11,#table12,#table13,#table14,#table15,#table16,#table17,#table18,#table19,#table20').DataTable({
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

<?php $form = ActiveForm::begin(); ?>

<div class="box box-primary box-solid collapsed-box">
    <div class="box-header with-border">
 
        <div class="col-md-2 col-sm-6 col-xs-12">
        <?= Html::a('Tambah Karyawan', ['create'],[
                            'class' => 'btn btn-default',
                            'data-toggle'=>"modal",
                            'data-target'=>"#myModal",
                        ]); ?>
        </div>

        <div class="col-md-2 col-sm-6 col-xs-12">
        <?php 
            $a=array(
                 "All"=>"All",
                 "Departemen"=>"Departemen",
                 "Group"=>"Group",
                 "Jabatan"=>"Jabatan",
                 "Status"=>"Status",
                 "Lokasi"=>"Lokasi",
                 "Aktif"=>"Aktif",
                 "Bank"=>"Bank",
                 "Cabang"=>"Cabang",
                 "Umur"=>"Umur",
                 "Masakerja"=>"Masakerja",
                 "Jenis Kelamin"=>"Jenis Kelamin",
                 "Agama"=>"Agama",
                );
            echo Select2::widget([
                'name' => 'id_filter',
                'data' => $a,
                'value'=> "Departemen",
                'options' => [
                    'placeholder' => 'Filter',
                ],
            ]);
        ?>
        </div>

        <div class="col-md-2 col-sm-6 col-xs-12">
           <?= Html::submitButton('Filter', ['class' => 'btn btn-default','name'=>'tombol','value'=>'filter']); ?>
        </div>

      <div class="box-tools pull-right">
      <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>  
      </div>
    </div>
    <div class="box-body" style="display: none;">
        <div class="table-responsive">
        <table class='table table-striped table-hover table-bordered' id='mytable'>
        <thead>
            <tr>
            <th width="5%" align="center">Menu</th>
            <th width="5%" align="center">No</th>
            <th align="center">NIK</th>
            <th align="center">Nama Lengkap</th>
            <th align="center">Departemen</th>
            <th align="center">Jabatan</th>
            <th align="center">Status</th>
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
                    <?=Html::a("...", ['view', 'id' => $row->id_karyawan], ['class' => 'btn btn-primary btn-xs','data-toggle'=>"modal",
                                'data-target'=>"#myModal",])?>
                </td>
                <td bgcolor="<?=$warna?>" align="center"><?=$no?></td>
                <td bgcolor="<?=$warna?>"><?=$row->nik?></td>
                <td bgcolor="<?=$warna?>"><?=$row->nama_karyawan ?></td>
                <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->getNamaDepartemen($row->id_departemen)?></td>
                <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->getNamaJabatan($row->id_jabatan)?></td>
                <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->getNamaStatus($row->id_status)?></td>
            </tr>
        <?php $no++; } ?>
        </tbody>
        </table>
        </div>
    </div>
</div>



<?php
$n=1;
foreach($myfilter as $rr){ 
?>
        <div class="box box-primary box-solid">
            <div class="box-header with-border">

            <?php
                if($id_filter=="Departemen"){
                    $idfilter = $rr->id_departemen;
                    $namafilter = $rr->nama_departemen; 
                    $query="SELECT *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur , TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja from master_karyawan
                            WHERE aktif=1 and id_departemen='$idfilter'
                            order by id_karyawan asc;";
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();
                    $jmlfilter = count($karyawan);             
                }else if($id_filter=="Jabatan"){
                    $idfilter = $rr->id_jabatan;
                    $namafilter = $rr->nama_jabatan;   
                    $query="SELECT *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja from master_karyawan
                            WHERE aktif=1 and id_jabatan='$idfilter'
                            order by id_karyawan asc;";
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();   
                    $jmlfilter = count($karyawan); 
                }else if($id_filter=="Group"){
                    $idfilter = $rr->id_group;
                    $namafilter = $rr->nama_group;   
                    $query="SELECT *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja from master_karyawan
                            WHERE aktif=1 and id_group='$idfilter'
                            order by id_karyawan asc;";
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();   
                    $jmlfilter = count($karyawan);                 
                }else if($id_filter=="Status"){
                    $idfilter = $rr->id_status; 
                    $namafilter = $rr->nama_status;
                    $query="SELECT *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja from master_karyawan
                            WHERE  id_status='$idfilter'
                            order by id_karyawan asc;";
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();    
                    $jmlfilter = count($karyawan);                
                }else if($id_filter=="Lokasi"){
                    $idfilter = $rr->id_lokasi; 
                    $namafilter = $rr->nama_lokasi; 
                    $query="SELECT *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja from master_karyawan
                            WHERE aktif=1 and id_lokasi='$idfilter'
                            order by id_karyawan asc;";
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();   
                    $jmlfilter = count($karyawan); 
                }else if($id_filter=="Aktif"){
                    $idfilter = $rr;
                    $idfilter==1 ?  $namafilter = "Aktif" : $namafilter = "Nonaktif";
                    $query="SELECT *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja from master_karyawan
                            WHERE aktif=$idfilter
                            order by id_karyawan asc;";
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();   
                    $jmlfilter = count($karyawan); 
                }else if($id_filter=="All"){
                    $idfilter = $rr;
                    $namafilter = "Semua Karyawan Aktif";
                    $query="SELECT *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja from master_karyawan
                            WHERE aktif=1
                            order by id_karyawan asc;";
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();   
                    $jmlfilter = count($karyawan); 
                }else if($id_filter=="Jenis Kelamin"){
                    $idfilter = $rr;
                    $idfilter==1 ?  $namafilter = "Laki-Laki" : $namafilter = "Perempuan";
                    $query="SELECT *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja from master_karyawan
                            WHERE aktif=1 and jk='$idfilter'
                            order by id_karyawan asc;";
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();   
                    $jmlfilter = count($karyawan);  
                }else if($id_filter=="Agama"){
                    $idfilter = $rr;
                    $namafilter = $rr;
        
                    $query="SELECT *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja from master_karyawan
                            WHERE aktif=1 and agama='$idfilter'
                            order by id_karyawan asc;";
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();   
                    $jmlfilter = count($karyawan);  
                }else if($id_filter=="Bank"){
                    $idfilter = $rr->id_bank; 
                    $namafilter = $rr->nama_bank; 
                    $query="SELECT *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja from master_karyawan
                            WHERE aktif=1 and id_bank='$idfilter'
                            order by id_karyawan asc;";
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();      
                    $jmlfilter = count($karyawan); 
                }else if($id_filter=="Cabang"){
                    $idfilter = $rr->id_cabang; 
                    $namafilter = $rr->nama_cabang; 
                    $query="SELECT *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja from master_karyawan
                            WHERE aktif=1 and id_cabang='$idfilter'
                            order by id_karyawan asc;";
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();  
                    $jmlfilter = count($karyawan); 
                }else if($id_filter=="Umur"){
                    $idfilter = $rr;

                    if($idfilter==1){
                        $namafilter = "Umur 0-20 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 0 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <21)
                                order by id_karyawan asc";
                    }else if($idfilter==2){
                        $namafilter = "Umur 21-30 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 20 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <31)
                                order by id_karyawan asc";
                    }else if($idfilter==3){
                        $namafilter = "Umur 31-40 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 30 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <41)
                                order by id_karyawan asc";
                    }else if($idfilter==4){
                        $namafilter = "Umur 41-50 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 40 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <51)
                                order by id_karyawan asc";
                    }else if($idfilter==5){
                        $namafilter = "Umur Diatas 50 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 50 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <100)
                                order by id_karyawan asc";
                    }
                    
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();    
                    $jmlfilter = count($karyawan);  
                }else if($id_filter=="Masakerja"){
                    $idfilter = $rr;
                    if($idfilter==0){
                        $namafilter = "Masa Kerja Dibawah 1 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) < 1)
                                order by id_karyawan asc";
                    }else if($idfilter==1){
                        $namafilter = "Masa Kerja 1 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) = 1)
                                order by id_karyawan asc";
                    }else if($idfilter==2){
                        $namafilter = "Masa Kerja 2 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) = 2)
                                order by id_karyawan asc";
                    }else if($idfilter==3){
                        $namafilter = "Masa Kerja 3 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) = 3)
                                order by id_karyawan asc";
                    }else if($idfilter==4){
                        $namafilter = "Masa Kerja 4 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) = 4)
                                order by id_karyawan asc";
                    }else if($idfilter==5){
                        $namafilter = "Masa Kerja 5 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) = 5)
                                order by id_karyawan asc";
                    }else if($idfilter==6){
                        $namafilter = "Masa Kerja 6 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) = 6)
                                order by id_karyawan asc";
                    }else if($idfilter==7){
                        $namafilter = "Masa Kerja 7 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =7)
                                order by id_karyawan asc";
                    }else if($idfilter==8){
                        $namafilter = "Masa Kerja 8 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) = 8)
                                order by id_karyawan asc";
                    }else if($idfilter==9){
                        $namafilter = "Masa Kerja Lebih dari 8 Tahun";
                        $query="SELECT
                                *,TIMESTAMPDIFF(YEAR,tgl_lahir,curdate()) AS umur, TIMESTAMPDIFF(YEAR,tgl_masuk,curdate()) AS masakerja
                                from master_karyawan
                                WHERE aktif=1
                                AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) > 8)
                                order by id_karyawan asc";
                    }
                    
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();    
                    $jmlfilter = count($karyawan);                 
                }else {
                    $idfilter = $rr->id_departemen;
                    $namafilter = $rr->nama_departemen; 
                    $query="SELECT * from master_karyawan
                            WHERE aktif=1 and id_departemen='$idfilter'
                            order by id_karyawan asc;";
                    $karyawan = Yii::$app->db->createCommand($query)->queryAll();
                    $jmlfilter = count($karyawan);                
                }
            ?>
               <?=$n?>. &nbsp;<?=$namafilter?> ( <?=$jmlfilter?> )             
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
                    <th align="center">Group</th>
                    <th align="center">Jabatan</th>
                    <th align="center">Status</th>
                    <th align="center">Cabang</th>
                    <th align="center">Lokasi</th>
                    <th align="center">Umur</th>
                    <th align="center">Masa Kerja</th>
                    <th align="center">Jenis Kelamin</th>
                    <th align="center">Agama</th>
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
                            <?=Html::a("...", ['view', 'id' => $row['id_karyawan']], ['class' => 'btn btn-primary btn-xs','data-toggle'=>"modal",
                                        'data-target'=>"#myModal",])?>
                        </td>
                        <td bgcolor="<?=$warna?>" align="center"><?=$no?></td>
                        <td bgcolor="<?=$warna?>"><?=$row['nik']?></td>
                        <td bgcolor="<?=$warna?>"><?=$row['nama_karyawan'] ?></td>
                        <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->getNamaDepartemen($row['id_departemen'])?></td>
                        <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->getNamaGroup($row['id_group']) ?></td>
                        <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->getNamaJabatan($row['id_jabatan'])?></td>
                        <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->getNamaStatus($row['id_status'])?></td>
                        <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->getNamaCabang($row['id_cabang']) ?></td>
                        <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->getNamaLokasi($row['id_lokasi']) ?></td>
                        <td bgcolor="<?=$warna?>"><?=$row['umur'] ?></td>
                        <td bgcolor="<?=$warna?>"><?=$row['masakerja'] ?></td>
                        <td bgcolor="<?=$warna?>"><?=Yii::$app->fungsi->namaJk($row['jk'])?></td>
                        <td bgcolor="<?=$warna?>"><?=$row['agama'] ?></td>
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


<?php ActiveForm::end(); ?>






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



