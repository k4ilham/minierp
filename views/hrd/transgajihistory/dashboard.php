<?php
use app\models\hrd\MasterKaryawan;
use \onmotion\apexcharts\ApexchartsWidget;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\helpers\Url;

$this->title = 'Dashboard Gaji';
?>

<?php
    $periodeaktif = Yii::$app->helperdb->periodeAktif();
    isset($_GET['tahun']) ?  $tahun = $_GET['tahun'] : $tahun = date('Y');
    isset($_GET['periode']) ?  $periode = $_GET['periode'] : $periode = $periodeaktif;
?>

Periode :
    <?php foreach($list_tahun as $r){ ?>
        <?php if($r['thn'] == $tahun){ ?>
            <a href="<?=Url::base(true);?>/transgajihistory/dashboard?tahun=<?=$r['thn']?>&periode=<?=$periode?>" type="button" class="btn btn-danger btn-xs" ><?=$r['thn']?></a>
        <?php }else{ ?>
            <a href="<?=Url::base(true);?>/transgajihistory/dashboard?tahun=<?=$r['thn']?>&periode=<?=$periode?>" type="button" class="btn btn-primary btn-xs" ><?=$r['thn']?></a>
        <?php } ?>
    <?php } ?>

    &nbsp; - &nbsp;
    <?php foreach($list_periode as $r){ ?>
        <?php if($r['periode'] == $periode){ ?>
            <a href="<?=Url::base(true);?>/transgajihistory/dashboard?tahun=<?=$tahun?>&periode=<?=$r['periode']?>" type="button" class="btn btn-danger btn-xs" ><?=substr($r['periode'],5,6)?></a>
        <?php }else{ ?>
            <a href="<?=Url::base(true);?>/transgajihistory/dashboard?tahun=<?=$tahun?>&periode=<?=$r['periode']?>" type="button" class="btn btn-primary btn-xs" ><?=substr($r['periode'],5,6)?></a>
        <?php } ?>
    <?php } ?>

    <hr>


<div class="row">
        <div class="col-md-6"> 
                <!-- USERS LIST -->
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Gaji</h3>

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
                        $gaji_bersih = array();
                        $gapok = array();
                        $total_pendapatan = array();
                        $total_potongan = array();
                        $query="SELECT * FROM 
                        (SELECT periode,SUM(gaji_bersih)AS gaji_bersih,SUM(gapok)AS gapok,
                        SUM(total_pendapatan)AS total_pendapatan, SUM(total_potongan)AS total_potongan
                                FROM trans_gaji_history
                                GROUP BY periode
                                ORDER BY periode desc
                                LIMIT 12) AS a
                            ORDER BY a.periode asc";
                        $row = Yii::$app->db->createCommand($query)->queryAll();
                        foreach($row as $rr){
                            $a = array($rr['periode'], intval($rr['gaji_bersih']));
                            array_push($gaji_bersih,$a);

                            $b = array($rr['periode'], intval($rr['gapok']));
                            array_push($gapok,$b);

                            $c = array($rr['periode'], intval($rr['total_pendapatan']));
                            array_push($total_pendapatan,$c);

                            $d = array($rr['periode'], intval($rr['total_potongan']));
                            array_push($total_potongan,$d);
                        }
                        echo Highcharts::widget([
                            'options' => [
                               'title' => ['text' => 'Gaji All Periode'],
                               'yAxis' => [
                                  'title' => ['text' => 'Nominal']
                               ],
                               'xAxis' => [
                                'type' => 'category'
                               ],
                               'series' => array(
                                        array('type' => 'line',
                                            'name' => 'Gaji Pokok', 
                                            'data' => $gapok
                                        ),
                                        array('type' => 'line',
                                                'name' => 'Gaji Bersih', 
                                                'data' => $gaji_bersih
                                        ),
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
                    <h3 class="box-title">Karyawan</h3>

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
                        $jmlkaryawan = array();
                        $query="SELECT * FROM 
                                    (SELECT periode,count(id_karyawan) AS jmlkaryawan
                                    FROM trans_gaji_history
                                    GROUP BY periode
                                    ORDER BY periode desc
                                    LIMIT 12) AS a
                                ORDER BY a.periode asc";
                        $row = Yii::$app->db->createCommand($query)->queryAll();
                        foreach($row as $rr){
                            $a = array($rr['periode'], intval($rr['jmlkaryawan']));
                            array_push($jmlkaryawan,$a);
                        }
                        echo Highcharts::widget([
                            'options' => [
                               'title' => ['text' => 'Karyawan All Periode'],
                               'yAxis' => [
                                  'title' => ['text' => 'Nominal']
                               ],
                               'xAxis' => [
                                'type' => 'category'
                               ],
                               'series' => array(
                                        array('type' => 'line',
                                            'name' => 'Jumlah Karyawan', 
                                            'data' => $jmlkaryawan
                                        ),
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



</div>
<!-- /.row -->


<div class="row">
        <div class="col-md-6"> 
                <!-- USERS LIST -->
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tunjangan</h3>

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
                        $tunj_masakerja = array();
                        $tunj_jabatan = array();
                        $tunj_keahlian = array();
                        $tunj_lain = array();
                        $query="SELECT * FROM 
                                    (SELECT periode,
                                    SUM(tunj_masakerja)AS tunj_masakerja,
                                    SUM(tunj_jabatan)AS tunj_jabatan,
                                    SUM(tunj_keahlian)AS tunj_keahlian, 
                                    SUM(tunj_lain)AS tunj_lain
                                    FROM trans_gaji_history
                                    GROUP BY periode
                                    ORDER BY periode desc
                                    LIMIT 12) AS a
                                ORDER BY a.periode asc";
                        $row = Yii::$app->db->createCommand($query)->queryAll();
                        foreach($row as $rr){
                            $a = array($rr['periode'], intval($rr['tunj_masakerja']));
                            array_push($tunj_masakerja,$a);

                            $b = array($rr['periode'], intval($rr['tunj_jabatan']));
                            array_push($tunj_jabatan,$b);

                            $c = array($rr['periode'], intval($rr['tunj_keahlian']));
                            array_push($tunj_keahlian,$c);

                            $d = array($rr['periode'], intval($rr['tunj_lain']));
                            array_push($tunj_lain,$d);
                        }
                        echo Highcharts::widget([
                            'options' => [
                               'title' => ['text' => 'Tunjangan All Periode'],
                               'yAxis' => [
                                  'title' => ['text' => 'Nominal']
                               ],
                               'xAxis' => [
                                'type' => 'category'
                               ],
                               'series' => array(
                                        array('type' => 'line',
                                            'name' => 'T.Masa Kerja', 
                                            'data' => $tunj_masakerja
                                        ),
                                        array('type' => 'line',
                                                'name' => 'T.Jabatan', 
                                                'data' => $tunj_jabatan
                                        ),
                                        array('type' => 'line',
                                            'name' => 'T.Keahlian', 
                                            'data' => $tunj_keahlian
                                        ),
                                        array('type' => 'line',
                                                'name' => 'T.Lain', 
                                                'data' => $tunj_lain
                                        ),
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
                    <h3 class="box-title">Potongan</h3>

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
                        $pot_kedisplinan = array();
                        $pot_lain = array();
                        $bpjskes = array();
                        $bpjstk = array();
                        $pensiun = array();
                        $query="SELECT * FROM 
                                    (SELECT periode,
                                    SUM(pot_kedisplinan)AS pot_kedisplinan,
                                    SUM(pot_lain)AS pot_lain,
                                    SUM(bpjskes)AS bpjskes, 
                                    SUM(bpjstk)AS bpjstk,
                                    SUM(pensiun)AS pensiun
                                    FROM trans_gaji_history
                                    GROUP BY periode
                                    ORDER BY periode desc
                                    LIMIT 12) AS a
                                ORDER BY a.periode asc";
                        $row = Yii::$app->db->createCommand($query)->queryAll();
                        foreach($row as $rr){
                            $a = array($rr['periode'], intval($rr['pot_kedisplinan']));
                            array_push($pot_kedisplinan,$a);

                            $b = array($rr['periode'], intval($rr['pot_lain']));
                            array_push($pot_lain,$b);

                            $c = array($rr['periode'], intval($rr['bpjskes']));
                            array_push($bpjskes,$c);

                            $d = array($rr['periode'], intval($rr['bpjstk']));
                            array_push($bpjstk,$d);

                            $e = array($rr['periode'], intval($rr['pensiun']));
                            array_push($pensiun,$e);
                        }
                        echo Highcharts::widget([
                            'options' => [
                               'title' => ['text' => 'Potongan All Periode'],
                               'yAxis' => [
                                  'title' => ['text' => 'Nominal']
                               ],
                               'xAxis' => [
                                'type' => 'category'
                               ],
                               'series' => array(
                                        array('type' => 'line',
                                            'name' => 'P. Kedisplinan', 
                                            'data' => $pot_kedisplinan
                                        ),
                                        array('type' => 'line',
                                                'name' => 'P. Lain', 
                                                'data' => $pot_lain
                                        ),
                                        array('type' => 'line',
                                            'name' => 'BPJS Kesehatan', 
                                            'data' => $bpjskes
                                        ),
                                        array('type' => 'line',
                                                'name' => 'BPJS TK', 
                                                'data' => $bpjstk
                                        ),
                                        array('type' => 'line',
                                                'name' => 'Pensiun', 
                                                'data' => $pensiun
                                        ),
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



</div>
<!-- /.row -->




