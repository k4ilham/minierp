<?php
use yii\helpers\Url;
use hscstudio\mimin\components\Mimin;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img  src="<?=Url::base(true)?>/file/uploads/user/<?=\Yii::$app->user->identity->photo?>" class="user-image" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=\Yii::$app->user->identity->username?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> User</a>
            </div>
        </div>



<?php
        
        if(Mimin::checkRoute('/crm/mastercustomer/index',true)){ 
            $mastercustomer = ['label' => 'Master Customer', 'icon' => 'circle', 'url' => ['/crm/mastercustomer'],];
        }else{
            $mastercustomer = [];
        }

        if(Mimin::checkRoute('/purchasing/mastervendor/index',true)){ 
            $mastervendor = ['label' => 'Master Vendor', 'icon' => 'circle', 'url' => ['/purchasing/mastervendor'],];
        }else{
            $mastervendor = [];
        }

        if(Mimin::checkRoute('/inventory/masterproductcategory/index',true)){ 
            $masterproduct = ['label' => 'Master Product Category', 'icon' => 'circle', 'url' => ['/inventory/masterproductcategory'],];
        }else{
            $masterproduct = [];
        }

        if(Mimin::checkRoute('/inventory/masterproduct/index',true)){ 
            $masterproductcategory = ['label' => 'Master Product', 'icon' => 'circle', 'url' => ['/inventory/masterproduct'],];
        }else{
            $masterproductcategory = [];
        }


        if(Mimin::checkRoute('/hrd/masterstatus/index',true)){ 
            $masterstatus = ['label' => 'Status', 'icon' => 'circle', 'url' => ['/hrd/masterstatus'],];
        }else{
            $masterstatus = [];
        }

        if(Mimin::checkRoute('/hrd/mastercabang/index',true)){ 
            $mastercabang = ['label' => 'Cabang', 'icon' => 'circle', 'url' => ['/hrd/mastercabang'],];
        }else{
            $mastercabang = [];
        }

        if(Mimin::checkRoute('/hrd/masterdepartemen/index',true)){ 
            $masterdepartemen = ['label' => 'Departemen', 'icon' => 'circle', 'url' => ['/hrd/masterdepartemen'],];
        }else{
            $masterdepartemen = [];
        }

        if(Mimin::checkRoute('/hrd/mastergroup/index',true)){ 
            $mastergroup = ['label' => 'Group', 'icon' => 'circle', 'url' => ['/hrd/mastergroup'],];
        }else{
            $mastergroup = [];
        }

        if(Mimin::checkRoute('/hrd/masterlokasi/index',true)){ 
            $masterlokasi = ['label' => 'Lokasi Kerja', 'icon' => 'circle', 'url' => ['/hrd/masterlokasi'],];
        }else{
            $masterlokasi = [];
        }

        if(Mimin::checkRoute('/hrd/masterjabatan/index',true)){ 
            $masterjabatan = ['label' => 'Jabatan', 'icon' => 'circle', 'url' => ['/hrd/masterjabatan'],];
        }else{
            $masterjabatan = [];
        }

        if(Mimin::checkRoute('/hrd/masterbank/index',true)){ 
            $masterbank = ['label' => 'Bank', 'icon' => 'circle', 'url' => ['/hrd/masterbank'],];
        }else{
            $masterbank = [];
        }

        if(Mimin::checkRoute('/hrd/masterjamkerja/index',true)){ 
            $masterjamkerja = ['label' => 'Jam Kerja', 'icon' => 'circle', 'url' => ['/hrd/masterjamkerja'],];
        }else{
            $masterjamkerja = [];
        }

        if(Mimin::checkRoute('/hrd/mastercutikhusus/index',true)){ 
            $mastercutikhusus = ['label' => 'Cuti Khusus', 'icon' => 'circle', 'url' => ['/hrd/mastercutikhusus'],];
        }else{
            $mastercutikhusus = [];
        }

        if(Mimin::checkRoute('/hrd/masterkaryawan/dashboard',true)){ 
            $masterkaryawandashboard = ['label' => 'Dashboard', 'icon' => 'circle', 'url' => ['/hrd/masterkaryawan/dashboard'],];
        }else{
            $masterkaryawandashboard = [];
        }

        if(Mimin::checkRoute('/hrd/masterkaryawan/uploadkaryawan',true)){ 
            $masterkaryawanuploadkaryawan = ['label' => 'Upload Karyawan', 'icon' => 'circle', 'url' => ['/hrd/masterkaryawan/uploadkaryawan'],];
        }else{
            $masterkaryawanuploadkaryawan = [];
        }


        if(Mimin::checkRoute('/hrd/masterkaryawan/index',true)){ 
            $masterkaryawan = ['label' => 'Data Karyawan', 'icon' => 'circle', 'url' => ['/hrd/masterkaryawan'],];
        }else{
            $masterkaryawan = [];
        }

        

        if(Mimin::checkRoute('/hrd/masterkaryawan/index',true)){ 
            $transbank = ['label' => 'Data Bank', 'icon' => 'circle', 'url' => ['/hrd/transbank'],];
        }else{
            $transbank = [];
        }

        if(Mimin::checkRoute('/hrd/masterkaryawan/kontrak',true)){ 
            $masterkaryawankontrak = ['label' => 'Data Kontrak', 'icon' => 'circle', 'url' => ['/hrd/masterkaryawan/kontrak'],];
        }else{
            $masterkaryawankontrak = [];
        }

        if(Mimin::checkRoute('/hrd/masterkaryawan/report',true)){ 
            $masterkaryawanreport = ['label' => 'Report Karyawan', 'icon' => 'circle', 'url' => ['/hrd/masterkaryawan/report'],];
        }else{
            $masterkaryawanreport = [];
        }

        //absensi
        if(Mimin::checkRoute('/hrd/translibur/index',true)){ 
            $translibur = ['label' => 'Hari Libur', 'icon' => 'circle', 'url' => ['/hrd/translibur'],];
        }else{
            $translibur = [];
        }

        if(Mimin::checkRoute('/hrd/transabsensi/ratekehadiran',true)){ 
            $transabsensiratekehadiran = ['label' => 'Rate Kehadiran', 'icon' => 'circle', 'url' => ['/hrd/transabsensi/ratekehadiran'],];
        }else{
            $transabsensiratekehadiran = [];
        }

        if(Mimin::checkRoute('/hrd/transabsensi/jamkerja',true)){ 
            $transabsensijamkerja = ['label' => 'Jam Kerja', 'icon' => 'circle', 'url' => ['/hrd/transabsensi/jamkerja'],];
        }else{
            $transabsensijamkerja = [];
        }

        if(Mimin::checkRoute('/hrd/transabsensi/uploadabsen',true)){ 
            $transabsensiuploadabsen = ['label' => 'Upload Absensi', 'icon' => 'circle', 'url' => ['/hrd/transabsensi/uploadabsen'],];
        }else{
            $transabsensiuploadabsen = [];
        }

        if(Mimin::checkRoute('/hrd/transabsensi/index',true)){ 
            $transabsensi = ['label' => 'Finger Absensi', 'icon' => 'circle', 'url' => ['/hrd/transabsensi'],];
        }else{
            $transabsensi = [];
        }

        if(Mimin::checkRoute('/hrd/transabsensimanual/index',true)){ 
            $transabsensimanual = ['label' => 'Manual Absensi', 'icon' => 'circle', 'url' => ['/hrd/transabsensimanual'],];
        }else{
            $transabsensimanual = [];
        }

        if(Mimin::checkRoute('/hrd/transabsensikoreksi/index',true)){ 
            $transabsensikoreksi = ['label' => 'Koreksi Absensi', 'icon' => 'circle', 'url' => ['/hrd/transabsensikoreksi'],];
        }else{
            $transabsensikoreksi = [];
        }

        if(Mimin::checkRoute('/hrd/transabsensi/monitor',true)){ 
            $transabsensimonitor =  ['label' => 'Absen Per Karyawan', 'icon' => 'circle', 'url' => ['/hrd/transabsensi/monitor'],];
        }else{
            $transabsensimonitor = [];
        }

        if(Mimin::checkRoute('/hrd/transabsensi/monitor2',true)){ 
            $transabsensimonitor2 = ['label' => 'Monitoring Absensi', 'icon' => 'circle', 'url' => ['/hrd/transabsensi/monitor2'],];
        }else{
            $transabsensimonitor2 = [];
        }
                                  
        //cuti
        if(Mimin::checkRoute('/hrd/transoff/index',true)){ 
            $transoff = ['label' => 'Off Kerja', 'icon' => 'circle', 'url' => ['/hrd/transoff'],];
        }else{
            $transoff = [];
        }

        if(Mimin::checkRoute('/hrd/transsakit/index',true)){ 
            $transsakit = ['label' => 'Ijin Sakit', 'icon' => 'circle', 'url' => ['/hrd/transsakit'],];
        }else{
            $transsakit = [];
        }

        if(Mimin::checkRoute('/hrd/transcuti/index',true)){ 
            $transcuti = ['label' => 'Cuti Tahunan', 'icon' => 'circle', 'url' => ['/hrd/transcuti'],];
        }else{
            $transcuti = [];
        }

        if(Mimin::checkRoute('/hrd/transcutikhusus/index',true)){ 
            $transcutikhusus = ['label' => 'Cuti Khusus', 'icon' => 'circle', 'url' => ['/hrd/transcutikhusus'],];
        }else{
            $transcutikhusus = [];
        }

        if(Mimin::checkRoute('/hrd/transcuti/saldocuti',true)){ 
            $transcutisaldocuti = ['label' => 'Saldo Cuti', 'icon' => 'circle', 'url' => ['/hrd/transcuti/saldocuti'],];
        }else{
            $transcutisaldocuti = [];
        }
       
        //lembur
        if(Mimin::checkRoute('/hrd/translembur/dashboard',true)){ 
            $translemburdashboard = ['label' => 'Dashboard', 'icon' => 'circle', 'url' => ['/hrd/translembur/dashboard'],];
        }else{
            $translemburdashboard = [];
        }

        if(Mimin::checkRoute('/hrd/translembur/index',true)){ 
            $translembur = ['label' => 'Data Lembur', 'icon' => 'circle', 'url' => ['/hrd/translembur'],];
        }else{
            $translembur = [];
        }

        //penggajian
        if(Mimin::checkRoute('/hrd/transgajihistory/dashboard',true)){ 
            $transgajihistorydashboard = ['label' => 'Dashboard', 'icon' => 'circle', 'url' => ['/hrd/transgajihistory/dashboard'],];
        }else{
            $transgajihistorydashboard = [];
        }

        if(Mimin::checkRoute('/hrd/transgajipokok/index',true)){ 
            $transgajipokok = ['label' => 'Gaji Pokok', 'icon' => 'circle', 'url' => ['/hrd/transgajipokok'],];
        }else{
            $transgajipokok = [];
        }

        if(Mimin::checkRoute('/hrd/transtunjanganmasakerja/index',true)){ 
            $transtunjanganmasakerja = ['label' => 'Tunj Masa Kerja', 'icon' => 'circle', 'url' => ['/hrd/transtunjanganmasakerja'],];
        }else{
            $transtunjanganmasakerja = [];
        }

        if(Mimin::checkRoute('/hrd/transtunjanganjabatan/index',true)){ 
            $transtunjanganjabatan = ['label' => 'Tunj Jabatan', 'icon' => 'circle', 'url' => ['/hrd/transtunjanganjabatan'],];
        }else{
            $transtunjanganjabatan = [];
        }

        if(Mimin::checkRoute('/hrd/transtunjangankeahlian/index',true)){ 
            $transtunjangankeahlian = ['label' => 'Tunj Keahlian', 'icon' => 'circle', 'url' => ['/hrd/transtunjangankeahlian'],];
        }else{
            $transtunjangankeahlian = [];
        }

        if(Mimin::checkRoute('/hrd/transtunjanganlain/index',true)){ 
            $transtunjanganlain = ['label' => 'Tunj Lain', 'icon' => 'circle', 'url' => ['/hrd/transtunjanganlain'],];
        }else{
            $transtunjanganlain = [];
        }

        if(Mimin::checkRoute('/hrd/transpotongankedisplinan/index',true)){ 
            $transpotongankedisplinan = ['label' => 'Pot Kedisplinan', 'icon' => 'circle', 'url' => ['/hrd/transpotongankedisplinan'],];
        }else{
            $transpotongankedisplinan = [];
        }

        if(Mimin::checkRoute('/hrd/transpotonganlain/index',true)){ 
            $transpotonganlain = ['label' => 'Pot Lain', 'icon' => 'circle', 'url' => ['/hrd/transpotonganlain'],];
        }else{
            $transpotonganlain = [];
        }

        if(Mimin::checkRoute('/hrd/transgaji/posting',true)){ 
            $transgajiposting = ['label' => 'Posting Gaji', 'icon' => 'circle', 'url' => ['/hrd/transgaji/posting'],];
        }else{
            $transgajiposting = [];
        }

        if(Mimin::checkRoute('/hrd/transgaji/index',true)){ 
            $transgaji = ['label' => 'Gaji '.Yii::$app->helperdb->periodeAktif(), 'icon' => 'circle', 'url' => ['/hrd/transgaji'],];                     
        }else{
            $transgaji = [];
        }

        if(Mimin::checkRoute('/hrd/transgajihistory/index',true)){ 
            $transgajihistory = ['label' => 'History Gaji', 'icon' => 'circle', 'url' => ['/hrd/transgajihistory'],];
        }else{
            $transgajihistory = [];
        }

        if(Mimin::checkRoute('/hrd/transgaji/anggarangaji',true)){ 
            $transgajianggarangaji = ['label' => 'Anggaran Gaji', 'icon' => 'circle', 'url' => ['/hrd/transgaji/anggarangaji'],];
        }else{
            $transgajianggarangaji = [];
        }

        if(Mimin::checkRoute('/hrd/transgaji/closebook',true)){ 
            $transgajiclosebook = ['label' => 'Tutup Buku', 'icon' => 'circle', 'url' => ['/hrd/transgaji/closebook'],];
        }else{
            $transgajiclosebook = [];
        }
                  
        //pengaturan
        if(Mimin::checkRoute('/hrd/masterpengaturan/index',true)){ 
            $masterpengaturan = ['label' => 'Pengaturan', 'icon' => 'circle', 'url' => ['/hrd/masterpengaturan'],];
        }else{
            $masterpengaturan = [];
        }

        if(Mimin::checkRoute('/hrd/masterkalender/index',true)){ 
            $masterkalender = ['label' => 'Kalender', 'icon' => 'circle', 'url' => ['/hrd/masterkalender'],];
        }else{
            $masterkalender = [];
        }

        if(Mimin::checkRoute('/hrd/transperiode/index',true)){ 
            $transperiode = ['label' => 'Periode', 'icon' => 'circle', 'url' => ['/hrd/transperiode'],];
        }else{
            $transperiode = [];
        }

        if(Mimin::checkRoute('/hrd/transuser/index',true)){ 
            $transuser = ['label' => 'Create User', 'icon' => 'circle', 'url' => ['/hrd/transuser'],];
        }else{
            $transuser = [];
        }  
        
        if(Mimin::checkRoute('/mimin/user',true)){ 
            $miminuser = ['label' => 'Change Role', 'icon' => 'circle', 'url' => ['/mimin/user'],];
        }else{
            $miminuser = [];
        } 

        if(Mimin::checkRoute('/mimin/route',true)){ 
            $miminroute = ['label' => 'Create Route', 'icon' => 'circle', 'url' => ['/mimin/route'],];
        }else{
            $miminroute = [];
        } 

        if(Mimin::checkRoute('/mimin/role',true)){ 
            $miminrole = ['label' => 'Create Role', 'icon' => 'circle', 'url' => ['/mimin/role'],];
        }else{
            $miminrole = [];
        } 
          
        
        
        

?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'ERP', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'home', 'url' => ['/']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],


                    // HRD
                    [
                        'label' => 'ERP',
                        'icon' => 'server',
                        'url' => '#',
                        'items' => [

                            //CRM
                            [
                                'label' => 'CRM',
                                'icon' => 'calendar',
                                'url' => '#',
                                'items' => [

                                    $mastercustomer,

                                    
                                ],
                            ],

                            //PURCHASING
                            [
                                'label' => 'PURCHASING',
                                'icon' => 'calendar',
                                'url' => '#',
                                'items' => [

                                    $mastervendor,

                                    
                                ],
                            ],

                            //INVENTORY
                            [
                                'label' => 'INVENTORY',
                                'icon' => 'calendar',
                                'url' => '#',
                                'items' => [

                                    $masterproduct,
                                    $masterproductcategory

                                    
                                ],
                            ],







                            // HRD
                            [
                                'label' => 'HRD',
                                'icon' => 'server',
                                'url' => '#',
                                'items' => [



                            //Karyawan
                            [
                                'label' => 'Karyawan',
                                'icon' => 'user',
                                'url' => '#',
                                'items' => [
                

                                    //Data Master
                                    [
                                        'label' => 'Data Master',
                                        'icon' => 'database',
                                        'url' => '#',
                                        'items' => [
                                                                            
                                            $masterstatus,
                                            $mastercabang,
                                            $masterdepartemen,
                                            $mastergroup,
                                            $masterlokasi,
                                            $masterjabatan,
                                            $masterbank,
                                            $masterjamkerja,
                                            $mastercutikhusus,

                                        ],
                                    ],

                                    $masterkaryawandashboard,
                                    $masterkaryawanuploadkaryawan,
                                    $masterkaryawan,
                                    $transbank,
                                    $masterkaryawankontrak,
                                    $masterkaryawanreport,


                                ],
                            ],

                            //Absensi
                            [
                                'label' => 'Absensi',
                                'icon' => 'calendar',
                                'url' => '#',
                                'items' => [

                                    $translibur,
                                    $transabsensiratekehadiran,
                                    $transabsensijamkerja,
                                    $transabsensiuploadabsen,
                                    $transabsensi,
                                    $transabsensimanual,
                                    $transabsensikoreksi,
                                    $transabsensimonitor,
                                    $transabsensimonitor2,

                                    
                                ],
                            ],

                            //Cuti
                            [
                                'label' => 'Cuti & Ijin',
                                'icon' => 'stack-overflow',
                                'url' => '#',
                                'items' => [

                                    $transoff,
                                    $transsakit,
                                    $transcuti,
                                    $transcutikhusus,
                                    $transcutisaldocuti,

                                ],
                            ],

                            //Lembur
                            [
                                'label' => 'Lembur',
                                'icon' => 'stack-overflow',
                                'url' => '#',
                                'items' => [
                                    $translemburdashboard,
                                    $translembur,
                                ],
                            ],




                            //Penggajian
                            [
                                'label' => 'Penggajian',
                                'icon' => 'money',
                                'url' => '#',
                                'items' => [

                                    $transgajihistorydashboard,
                                    $transgajipokok,
                                    $transtunjanganmasakerja,
                                    $transtunjanganjabatan,
                                    $transtunjangankeahlian,
                                    $transtunjanganlain,
                                    $transpotongankedisplinan,
                                    $transpotonganlain,
                                    $transgajiposting,
                                    $transgaji,                    
                                    $transgajihistory,
                                    $transgajianggarangaji,
                                    $transgajiclosebook,

                                ],
                            ],

                            //Pengaturan
                            [
                                'label' => 'Pengaturan',
                                'icon' => 'server',
                                'url' => '#',
                                'items' => [
                                    $masterpengaturan,
                                    $masterkalender,
                                    $transperiode,
                                    $transuser,
                                    $miminuser,
                                    $miminroute,
                                    $miminrole,
                                ],
                            ],






                                ],
                            ],






                        ]
                        ],




                    
                ],
            ]
        ) ?>

    </section>

</aside>
