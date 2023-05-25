<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use miloschuman\highcharts\Highcharts;
use \onmotion\apexcharts\ApexchartsWidget;

$this->title = 'Monitoring Absensi';
$this->params['breadcrumbs'][] = $this->title;

$js = <<<js
	$('#mytable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      "lengthMenu": [ [100, 25, 50, 100, 500, 100, -1],[100, 25, 50, 100, 500, 1000, "All"] ],
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
<div class="box box-primary box-solid">
    <div class="box-header with-border">
 
    <?php
    $periodeaktif = Yii::$app->helperdb->periodeAktif();
    $per = Yii::$app->helperdb->getTabelPeriode($periodeaktif);
    if($per){
        $dawal = $per['tgl_absen_awal'];
        $dakhir = $per['tgl_absen_akhir'];
    }else{
        $dawal = date("Y-m-d");
        $dakhir = date("Y-m-d");
    }
?>
        <div class="col-md-2 col-sm-6 col-xs-12">
        <?php 
            echo DatePicker::widget([
                'name' => 'tgl_awal',
                'options' => ['placeholder' => 'Tgl Awal'],
                'type' => DatePicker::TYPE_INPUT,
                'value' => date("Y-m-d",strtotime($dawal)),
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
        ?>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12">
        <?php 
            echo DatePicker::widget([
                'name' => 'tgl_akhir',
                'options' => ['placeholder' => 'Tgl Akhir'],
                'type' => DatePicker::TYPE_INPUT,
                'value' => date("Y-m-d",strtotime($dakhir)),
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
        ?>
        </div>


           <?= Html::submitButton('Filter', ['class' => 'btn btn-default','name'=>'tombol','value'=>'filter']); ?>

      <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
      </div>
    </div>
    <div class="box-body">

    <div class="row">
            <div class="col-md-6"> 
                    <!-- USERS LIST -->
                    <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Monitoring Kehadiran</h3>

                        <div class="box-tools pull-right">

                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
            
                        <table class='table table-striped table-hover table-bordered' id='mytable2'>
                            <tr>
                                <td width="15%">Periode</td><td width="1%">:</td><td><?=$awal?> s/d <?=$akhir?></td>
                            </tr>

                            <tr>
                                <td width="15%">Rekap</td><td width="1%">:</td><td>
                                
                                    <?php
                                        $labels = array(); 
                                        $series = array();
                                        $labelseries = array();
                                        $query="SELECT * from master_tipeabsen order by id_tipeabsen asc";
                                        $data = Yii::$app->db->createCommand($query)->queryAll();
                                        foreach($data as $qq){
                                            $id_tipeabsen = $qq['id_tipeabsen'];
                                            $tipeabsen = $qq['tipeabsen'];
                                            $jmltipeabsen = Yii::$app->helperdb->jumlahRekapAbsenKaryawan($awal,$akhir,$id_tipeabsen);
                                            echo $tipeabsen;
                                            echo " = ";
                                            echo $jmltipeabsen;
                                            echo "<br>";

                                            array_push($labels,$tipeabsen);
                                            $jml = intval($jmltipeabsen);
                                            array_push($series,$jmltipeabsen);
                                            $a = array($tipeabsen, $jmltipeabsen);
                                            array_push($labelseries,$a);
                                        }
                                    ?>               
                                
                                </td>
                            </tr>


                        </table>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">

                    </div>
                    <!-- /.box-footer -->
                    </div>
                    <!--/.box -->
            </div>
            <!-- /.col -->


            <div class="col-md-6">
                    <!-- USERS LIST -->
                    <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Grafik</h3>

                        <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">

                    <?php

                            echo \onmotion\apexcharts\ApexchartsWidget::widget([
                                'type' => 'pie', // default area
                                'height' => '250', // default 350
                                'width' => '100%', // default 100%
                                'chartOptions' => [
                                    'chart' => [
                                        'toolbar' => [
                                            'show' => false,
                                            'autoSelected' => 'zoom'
                                        ],
                                    ],
                                    'plotOptions' => [
                                        'bar' => [
                                            'horizontal' => false,
                                            'endingShape' => 'rounded'
                                        ],
                                    ],
                                    'dataLabels' => [
                                        'enabled' => true
                                    ],
                                    'stroke' => [
                                        'show' => true,
                                        'colors' => ['transparent']
                                    ],
                                    'legend' => [
                                        'verticalAlign' => 'bottom',
                                        'horizontalAlign' => 'left',
                                    ],
                                    'labels' => $labels
                                ],
                                'series' => $series,
                            ]);
                        ?>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                
                    </div>
                    <!-- /.box-footer -->
                    </div>
                    <!--/.box -->
            </div>
            <!-- /.col -->
    </div>
    <!-- /.row -->



    
        <table class='table table-striped table-hover table-bordered' id='mytable'>
        <thead>
            <tr>
            <th width="5%" align="center">No</th>
            <th align="center">Nama</th>
            <th align="center">Alpa</th>
            <th align="center">Hadir</th>
            <th align="center">Sakit</th>
            <th align="center">Cuti Tahunan</th>
            <th align="center">Cuti Khusus</th>
            <th align="center">Libur SM</th>
            <th align="center">Libur Nasional</th>
            <th align="center">Off</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;
        foreach($model as $row){ 
            $warna = "";
            $id_karyawan = $row->id_karyawan;
            ?>
            <tr>
                <td bgcolor="<?=$warna?>" align="center"><?=$no?></td>
                <td bgcolor="<?=$warna?>"><?=$row->nama_karyawan?></td>
                <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->jumlahRekapAbsen($awal,$akhir,$id_karyawan,1)?></td>
                <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->jumlahRekapAbsen($awal,$akhir,$id_karyawan,2)?></td>
                <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->jumlahRekapAbsen($awal,$akhir,$id_karyawan,3)?></td>
                <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->jumlahRekapAbsen($awal,$akhir,$id_karyawan,4)?></td>
                <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->jumlahRekapAbsen($awal,$akhir,$id_karyawan,5)?></td>
                <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->jumlahRekapAbsen($awal,$akhir,$id_karyawan,6)?></td>
                <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->jumlahRekapAbsen($awal,$akhir,$id_karyawan,7)?></td>
                <td bgcolor="<?=$warna?>"><?=Yii::$app->helperdb->jumlahRekapAbsen($awal,$akhir,$id_karyawan,8)?></td>
            </tr>
        <?php $no++; } ?>
        </tbody>
        </table>
    </div>
</div>
<?php ActiveForm::end(); ?>

<?php
    Modal::begin([
        'header'=>'<h4>PT. INTAN JAYA MEDIKA SOLUSI</h4>',
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



