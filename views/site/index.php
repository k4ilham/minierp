<?php
use app\models\hrd\MasterKaryawan;
use \onmotion\apexcharts\ApexchartsWidget;
$this->title = 'Dashboard';
?>

<div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa  fa-calendar-times-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Periode</span>
              <span class="info-box-number"><?=Yii::$app->helperdb->periodeAktif()?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Karyawan</span>
              <span class="info-box-number"><?=Yii::$app->helperdb->jumlahKaryawanAktif()?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-stack-overflow"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Lembur</span>
              <span class="info-box-number"><?=number_format(Yii::$app->helperdb->jumlahjamLemburPeriode(Yii::$app->helperdb->periodeAktif()),2)?> Jam</span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Gaji</span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


</div>
<!-- /.row -->

<div class="row">
<div class="col-md-6">
        <!-- USERS LIST -->
        <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Karyawan Departemen</h3>

            <div class="box-tools pull-right">

            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <ul class="users-list clearfix">

            <?php
                $labels = array(); 
                $series = array();
                foreach($departemen as $rdep){
                    array_push($labels,$rdep->nama_departemen);
                    $jml = intval(Yii::$app->helperdb->jumlahKaryawanDepartemen($rdep->id_departemen));
                    array_push($series,$jml);
                }

                echo \onmotion\apexcharts\ApexchartsWidget::widget([
                    'type' => 'pie', // default area
                    'height' => '350', // default 350
                    'width' => '100%', // default 100%
                    'chartOptions' => [
                        'chart' => [
                            'toolbar' => [
                                'show' => true,
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

            <hr>
            <center><h4>Karyawan Baru</h4></center>
            <?php 
              $kar = Yii::$app->helperdb->dataKaryawanBaru();
              if($kar){
                  foreach($kar as $r){
            ?>
            <li>
                <img width="25" height="25" src="https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male2-512.png" alt="User Image">
                <a class="users-list-name" href="#"><?=$r['nama_karyawan']?></a>
                <span class="users-list-name"><?=$r['nama_departemen']?></span>
            </li>
            <?php
                    }
                }
            ?>

            </ul>
            <!-- /.users-list -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">
            <a href="masterkaryawan" class="uppercase">Lihat Semua Karyawan</a>
        </div>
        <!-- /.box-footer -->
        </div>
        <!--/.box -->
    </div>
    <!-- /.col -->


    <div class="col-md-3">
        <!-- USERS LIST -->
        <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Status Karyawan</h3>

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
                $labels = array(); 
                $series = array();

                
                foreach($liststatus as $rstatus){
                    //var_dump($rstatus);
                    array_push($labels,$rstatus->nama_status);
                    $jml = intval(Yii::$app->helperdb->jumlahKaryawanStatus($rstatus->id_status));
                    array_push($series,$jml);
                }
                //$labels = ['Kontrak','Tetap','Resign'];
                //$series = [60,10,10];

                echo \onmotion\apexcharts\ApexchartsWidget::widget([
                    'type' => 'pie', // default area
                    'height' => '350', // default 350
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

            <div class="table-responsive">
            <hr>
            <center><h4>Karyawan Resign</h4></center>
            <table class='table table-striped table-hover table-bordered' id='mytable2'>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                    </tr>        
                </thead>
                <tbody>
                        <?php 
                            $kar = Yii::$app->helperdb->dataKaryawanResign();
                            if($kar){
                                $no=1;
                                foreach($kar as $r){
                        ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$r['nama_karyawan']?></td>
                                <td><?=$r['nama_departemen']?></td>
                            </tr>
                        <?php
                                $no++;}
                            }
                        ?>
                </tbody>
            </table>
            </div>


        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">
    
        </div>
        <!-- /.box-footer -->
        </div>
        <!--/.box -->
    </div>
    <!-- /.col -->

    <div class="col-md-3">
        <!-- USERS LIST -->
        <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Habis kontrak</h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
        <div class="table-responsive">
            <table class='table table-striped table-hover table-bordered' id='mytable2'>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Berakhir</th>
                        <th>Sisa</th>
                    </tr>        
                </thead>
                <tbody>
                        <?php 
                            $kar = Yii::$app->helperdb->dataHabisKontrak30hari();
                            if($kar){
                                $no=1;
                                foreach($kar as $r){
                        ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$r['nik']?></td>
                                <td><?=$r['nama_karyawan']?></td>
                                <td><?=$r['akhir_kontrak']?></td>
                                <td><?=$r['sisa']?></td>
                            </tr>
                        <?php
                                $no++;}
                            }
                        ?>
                </tbody>
            </table>
            </div>
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

</div>
<!-- /.row -->

