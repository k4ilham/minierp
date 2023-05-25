<?php
use app\models\hrd\MasterKaryawan;
use \onmotion\apexcharts\ApexchartsWidget;
$this->title = 'Dashboard Karyawan';
?>




<div class="row">
        <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Departemen</h3>

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
                        foreach($listdepartemen as $r){
                            array_push($labels,$r->nama_departemen);
                            $jml = intval(Yii::$app->helperdb->jumlahKaryawanDepartemen($r->id_departemen));
                            array_push($series,$jml);
                        }

                        echo \onmotion\apexcharts\ApexchartsWidget::widget([
                            'type' => 'pie', // default area
                            'height' => '250', // default 350
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
                    <h3 class="box-title">Status</h3>

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

                        
                        foreach($liststatus as $r){
                            //var_dump($rstatus);
                            array_push($labels,$r->nama_status);
                            $jml = intval(Yii::$app->helperdb->jumlahKaryawanStatus($r->id_status));
                            array_push($series,$jml);
                        }
                        //$labels = ['Kontrak','Tetap','Resign'];
                        //$series = [60,10,10];

                        echo \onmotion\apexcharts\ApexchartsWidget::widget([
                            'type' => 'pie', // default area
                            'height' => '250', // default 350
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




<!-- BARIS BARU -->
<div class="row">
        <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Jabatan</h3>

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
                        foreach($listjabatan as $r){
                            array_push($labels,$r->nama_jabatan);
                            $jml = intval(Yii::$app->helperdb->jumlahKaryawanJabatan($r->id_jabatan));
                            array_push($series,$jml);
                        }

                        echo \onmotion\apexcharts\ApexchartsWidget::widget([
                            'type' => 'pie', // default area
                            'height' => '250', // default 350
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
                    <h3 class="box-title">Lokasi</h3>

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

                        
                        foreach($listlokasi as $r){
                            //var_dump($rstatus);
                            array_push($labels,$r->nama_lokasi);
                            $jml = intval(Yii::$app->helperdb->jumlahKaryawanLokasi($r->id_lokasi));
                            array_push($series,$jml);
                        }
                        //$labels = ['Kontrak','Tetap','Resign'];
                        //$series = [60,10,10];

                        echo \onmotion\apexcharts\ApexchartsWidget::widget([
                            'type' => 'pie', // default area
                            'height' => '250', // default 350
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





<!-- BARIS BARU -->
<div class="row">
        <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Bank</h3>

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
                        foreach($listbank as $r){
                            array_push($labels,$r->nama_bank);
                            $jml = intval(Yii::$app->helperdb->jumlahKaryawanBank($r->id_bank));
                            array_push($series,$jml);
                        }

                        echo \onmotion\apexcharts\ApexchartsWidget::widget([
                            'type' => 'pie', // default area
                            'height' => '250', // default 350
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
                    <h3 class="box-title">Group</h3>

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

                        
                        foreach($listgroup as $r){
                            //var_dump($rstatus);
                            array_push($labels,$r->nama_group);
                            $jml = intval(Yii::$app->helperdb->jumlahKaryawanGroup($r->id_group));
                            array_push($series,$jml);
                        }
                        //$labels = ['Kontrak','Tetap','Resign'];
                        //$series = [60,10,10];

                        echo \onmotion\apexcharts\ApexchartsWidget::widget([
                            'type' => 'pie', // default area
                            'height' => '250', // default 350
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




<!-- BARIS BARU -->
<div class="row">
        <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cabang</h3>

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
                        foreach($listcabang as $r){
                            array_push($labels,$r->nama_cabang);
                            $jml = intval(Yii::$app->helperdb->jumlahKaryawanCabang($r->id_cabang));
                            array_push($series,$jml);
                        }

                        echo \onmotion\apexcharts\ApexchartsWidget::widget([
                            'type' => 'pie', // default area
                            'height' => '250', // default 350
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
                    <h3 class="box-title">Aktif</h3>

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

                        
                        foreach($listAktif as $r){
                            //var_dump($rstatus);
                            $r==1 ?  $namafilter = "Aktif" : $namafilter = "Nonaktif";
                            array_push($labels,$namafilter);
                            $jml = intval(Yii::$app->helperdb->jumlahKaryawanAktifNonaktif($r));
                            array_push($series,$jml);
                        }
                        //$labels = ['Kontrak','Tetap','Resign'];
                        //$series = [60,10,10];

                        echo \onmotion\apexcharts\ApexchartsWidget::widget([
                            'type' => 'pie', // default area
                            'height' => '250', // default 350
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




<!-- BARIS BARU -->
<div class="row">
        <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Umur</h3>

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
                        foreach($listUmur as $r){

                            if($r==1){
                                $namafilter = "Umur 0-20 Tahun";
                            }else if($r==2){
                                $namafilter = "Umur 21-30 Tahun";
                            }else if($r==3){
                                $namafilter = "Umur 31-40 Tahun";
                            }else if($r==4){
                                $namafilter = "Umur 41-50 Tahun";
                            }else if($r==5){
                                $namafilter = "Umur Diatas 50 Tahun";
                            }

                            array_push($labels,$namafilter);
                            $jml = intval(Yii::$app->helperdb->jumlahKaryawanUmur($r));
                            array_push($series,$jml);
                        }

                        echo \onmotion\apexcharts\ApexchartsWidget::widget([
                            'type' => 'pie', // default area
                            'height' => '250', // default 350
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
                    <h3 class="box-title">Masa Kerja</h3>

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

                        
                        foreach($listMasaKerja as $r){
                            if($r==0){
                                $namafilter = "Masa Kerja Dibawah 1 Tahun";
                            }else if($r==1){
                                $namafilter = "Masa Kerja 1 Tahun";
                            }else if($r==2){
                                $namafilter = "Masa Kerja 2 Tahun";
                            }else if($r==3){
                                $namafilter = "Masa Kerja 3 Tahun";
                            }else if($r==4){
                                $namafilter = "Masa Kerja 4 Tahun";
                            }else if($r==5){
                                $namafilter = "Masa Kerja 5 Tahun";
                            }else if($r==6){
                                $namafilter = "Masa Kerja 6 Tahun";
                            }else if($r==7){
                                $namafilter = "Masa Kerja 7 Tahun";
                            }else if($r==8){
                                $namafilter = "Masa Kerja 8 Tahun";
                            }else if($r==9){
                                $namafilter = "Masa Kerja Lebih dari 8 Tahun";
                            }
                            array_push($labels,$namafilter);
                            $jml = intval(Yii::$app->helperdb->jumlahKaryawanmasakerja($r));
                            array_push($series,$jml);
                        }
                        //$labels = ['Kontrak','Tetap','Resign'];
                        //$series = [60,10,10];

                        echo \onmotion\apexcharts\ApexchartsWidget::widget([
                            'type' => 'pie', // default area
                            'height' => '250', // default 350
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



<!-- BARIS BARU -->
<div class="row">
        <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Jenis Kelamin</h3>

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
                        foreach($listJenisKelamin as $r){

                            $r==1 ?  $namafilter = "Laki-Laki" : $namafilter = "Perempuan";

                            array_push($labels,$namafilter);
                            $jml = intval(Yii::$app->helperdb->jumlahKaryawanJenisKelamin($r));
                            array_push($series,$jml);
                        }

                        echo \onmotion\apexcharts\ApexchartsWidget::widget([
                            'type' => 'pie', // default area
                            'height' => '250', // default 350
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
                    <h3 class="box-title">Agama</h3>

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

                        
                        foreach($listAgama as $r){
                            array_push($labels,$r);
                            $jml = intval(Yii::$app->helperdb->jumlahKaryawanAgama($r));
                            array_push($series,$jml);
                        }
                        //$labels = ['Kontrak','Tetap','Resign'];
                        //$series = [60,10,10];

                        echo \onmotion\apexcharts\ApexchartsWidget::widget([
                            'type' => 'pie', // default area
                            'height' => '250', // default 350
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



