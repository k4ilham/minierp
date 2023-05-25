<?php
use app\models\hrd\MasterKaryawan;
use \onmotion\apexcharts\ApexchartsWidget;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\helpers\Url;

$this->title = 'Dashboard Lembur';
?>

<?php
    $periodeaktif = Yii::$app->helperdb->periodeAktif();
    isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
    isset($_GET['periode']) ?  $periode = $_GET['periode'] : $periode = $periodeaktif;
?>

Periode :
    <?php foreach($list_tahun as $r){ ?>
        <?php if($r['thn'] == $tahun){ ?>
            <a href="<?=Url::base(true);?>/translembur/dashboard?tahun=<?=$r['thn']?>&periode=<?=$periode?>" type="button" class="btn btn-danger btn-xs" ><?=$r['thn']?></a>
        <?php }else{ ?>
            <a href="<?=Url::base(true);?>/translembur/dashboard?tahun=<?=$r['thn']?>&periode=<?=$periode?>" type="button" class="btn btn-primary btn-xs" ><?=$r['thn']?></a>
        <?php } ?>
    <?php } ?>

    &nbsp; - &nbsp;
    <?php foreach($list_periode as $r){ ?>
        <?php if($r['periode'] == $periode){ ?>
            <a href="<?=Url::base(true);?>/translembur/dashboard?tahun=<?=$tahun?>&periode=<?=$r['periode']?>" type="button" class="btn btn-danger btn-xs" ><?=substr($r['periode'],5,6)?></a>
        <?php }else{ ?>
            <a href="<?=Url::base(true);?>/translembur/dashboard?tahun=<?=$tahun?>&periode=<?=$r['periode']?>" type="button" class="btn btn-primary btn-xs" ><?=substr($r['periode'],5,6)?></a>
        <?php } ?>
    <?php } ?>

    <hr>


<div class="row">
        <div class="col-md-6"> 
                <!-- USERS LIST -->
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">All</h3>

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
                        $labelseries = array();
                        $query="SELECT a.periode,a.total FROM 
                                    (SELECT periode,SUM(uang_lembur)AS total 
                                    FROM trans_gaji_history
                                    GROUP BY periode
                                    ORDER BY periode desc
                                    LIMIT 12) AS a
                                ORDER BY a.periode asc";
                        $row = Yii::$app->db->createCommand($query)->queryAll();
                        foreach($row as $rr){
                            array_push($labels,$rr['periode']);
                            $jml = intval($rr['total']);
                            array_push($series,$jml);
                            $a = array($rr['periode'], $jml);
                            array_push($labelseries,$a);
                        }
                        $lemburperiodeaktif = intval(Yii::$app->helperdb->jumlahUangLemburPeriode($periode));
                        $a = array($periode, $lemburperiodeaktif);
                        array_push($labelseries,$a);

                        echo Highcharts::widget([
                            'options' => [
                               'title' => ['text' => 'Lembur All Periode'],
                               'yAxis' => [
                                  'title' => ['text' => 'Uang Lembur']
                               ],
                               'xAxis' => [
                                'type' => 'category'
                               ],
                               'series' => array(
                                array('type' => 'line',
                                      'name' => 'Uang Lembur', 
                                      'data' => $labelseries
                                )
                               )  
                            ]
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
                    <h3 class="box-title">Periode</h3>

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
                        $labelseries = array();
                        $query="SELECT a.periode,a.total FROM 
                                    (SELECT periode,SUM(uang_lembur)AS total 
                                    FROM trans_gaji_history
                                    GROUP BY periode
                                    ORDER BY periode desc
                                    LIMIT 12) AS a
                                ORDER BY a.periode asc";
                        $row = Yii::$app->db->createCommand($query)->queryAll();
                        foreach($row as $rr){
                            array_push($labels,$rr['periode']);
                            $jml = intval($rr['total']);
                            array_push($series,$jml);
                            $a = array($rr['periode'], $jml);
                            array_push($labelseries,$a);
                        }
                        $lemburperiodeaktif = intval(Yii::$app->helperdb->jumlahUangLemburPeriode($periode));
                        $a = array($periode, $lemburperiodeaktif);
                        array_push($labelseries,$a);

                        echo Highcharts::widget([
                            'options' => [
                               'title' => ['text' => 'Lembur All Periode'],
                               'yAxis' => [
                                  'title' => ['text' => 'Uang Lembur']
                               ],
                               'xAxis' => [
                                'type' => 'category'
                               ],
                               'series' => array(
                                array('type' => 'pie',
                                      'name' => 'Uang Lembur', 
                                      'data' => $labelseries
                                )
                               )  
                            ]
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
                        $labelseries = array();
                        foreach($listdepartemen as $r){
                            array_push($labels,$r->nama_departemen);
                            $jml = intval(Yii::$app->helperdb->jumlahLemburDepartemen($periode,$r->id_departemen));
                            array_push($series,$jml);
                            $a = array($r->nama_departemen, $jml);
                            array_push($labelseries,$a);
                        }


                        echo Highcharts::widget([
                            'options' => [
                               'title' => ['text' => 'Lembur Departemen '.$periode],
                               'yAxis' => [
                                  'title' => ['text' => 'Uang Lembur']
                               ],
                               'xAxis' => [
                                'type' => 'category'
                               ],
                               'series' => array(
                                array('type' => 'column',
                                      'name' => 'Uang Lembur', 
                                      'data' => $labelseries
                                )
                               )  
                            ]
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
                        $labelseries = array();
                        foreach($liststatus as $r){
                            array_push($labels,$r->nama_status);
                            $jml = intval(Yii::$app->helperdb->jumlahLemburStatus($periode,$r->id_status));
                            array_push($series,$jml);
                            $a = array($r->nama_status, $jml);
                            array_push($labelseries,$a);
                        }
                        //$labels = ['Kontrak','Tetap','Resign'];
                        //$series = [60,10,10];




                        echo Highcharts::widget([
                            'options' => [
                               'title' => ['text' => 'Lembur Status '.$periode],
                               'yAxis' => [
                                  'title' => ['text' => 'Uang Lembur']
                               ],
                               'xAxis' => [
                                'type' => 'category',

                               ],
                               'series' => array(
                                array('type' => 'column',
                                      'name' => 'Uang Lembur', 
                                      'data' => $labelseries
                                )
                               )  
                            ]
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









