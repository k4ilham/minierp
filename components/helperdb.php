<?php
    namespace app\components;
    use Yii;

    use app\models\User;
    use app\models\hrd\MasterKaryawan;
    use app\models\hrd\MasterDepartemen;
    use app\models\hrd\MasterJabatan;
    use app\models\hrd\MasterLokasi;
    use app\models\hrd\MasterStatus;
    use app\models\hrd\MasterCabang;
    use app\models\hrd\MasterGroup;
    use app\models\hrd\MasterPengaturan;
    use app\models\hrd\Transperiode;
    use app\models\hrd\TransLog;
    use app\models\hrd\MasterBank;
    use app\models\hrd\MasterTipeabsen;
    use app\models\hrd\MasterCutiKhusus;
    use app\models\hrd\MasterJamKerja;

    use app\models\inventory\MasterProduct;
    use app\models\inventory\MasterProductCategory;
    use app\models\crm\MasterCustomer;
    use app\models\purchasing\MasterVendor;

    use app\models\sales\TransSalesOrderHeader;

    use yii\base\Component;
    use yii\base\InvalidConfigException;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;

    


class Helperdb extends Component
{

    // mendapatkan aktif
    public function getNamaAktif($id){
        $cek = User::find()->where(['id' => $id])->one();
        if($cek){
            $name = $cek->username;
        }else{
            $name = "";
        }
        return $name;
     }

    // mendapatkan nama user
    public function getName($id){
       $cek = User::find()->where(['id' => $id])->one();
       if($cek){
           $name = $cek->username;
       }else{
           $name = "";
       }
       return $name;
    }

    // mendapatkan nik user
    public function getNik($id){
        $cek = User::find()->where(['id' => $id])->one();
        if($cek){
            $nik = $cek->nik;
        }else{
            $nik = "";
        }
        return $nik;
    }

    // mendapatkan username
    public function getUsername($id){
        $cek = User::find()->where(['id' => $id])->one();
        if($cek){
            $username = $cek->username;
        }else{
            $username = "";
        }
        return $username;
    }

    // mendapatkan email
    public function getEmail($id){
        $cek = User::find()->where(['id' => $id])->one();
        if($cek){
            $email = $cek->email;
        }else{
            $email = "";
        }
        return $email;
    }	


    
    // mendapatkan periode aktif
    public function periodeAktif(){
        $cek = Transperiode::find()->where(['aktif' => 1])->one();
        if($cek){
            $periode = $cek->periode;
        }else{
            $periode = "";
        }
        return $periode;
    }


    // mendapatkan list karyawan aktif 
    public function listKaryawan(){
        $kar = MasterKaryawan::find()->select('id_karyawan,nik,nama_karyawan')
        ->where(['aktif' => 1])
        ->orderBy('Nama_Karyawan ASC')
        ->all();
		$listkar = ArrayHelper::map($kar,'id_karyawan',function($model, $defaultValue) {
            return $model['nama_karyawan'].' ['.$model['nik'] . '] ';
        });
        return $listkar;
    }

    // mendapatkan list bank
    public function listBank(){
        $res = MasterBank::find()->select('id_bank,nama_bank')
        ->orderBy('nama_bank ASC')
        ->all();
		$list = ArrayHelper::map($res,'id_bank',function($model, $defaultValue) {
            return $model['nama_bank'];
        });
        return $list;
    }

    // mendapatkan list departemen
    public function listDepartemen(){
        $res = MasterDepartemen::find()->select('id_departemen,nama_departemen')
        ->orderBy('nama_departemen ASC')
        ->all();
		$list = ArrayHelper::map($res,'id_departemen',function($model, $defaultValue) {
            return $model['nama_departemen'];
        });
        return $list;
    }

    // mendapatkan list status
    public function listStatus(){
        $res = MasterStatus::find()->select('id_status,nama_status')
        ->orderBy('nama_status ASC')
        ->all();
		$list = ArrayHelper::map($res,'id_status',function($model, $defaultValue) {
            return $model['nama_status'];
        });
        return $list;
    }

    // mendapatkan list jabatan
    public function listJabatan(){
        $res = MasterJabatan::find()->select('id_jabatan,nama_jabatan')
        ->orderBy('nama_jabatan ASC')
        ->all();
		$list = ArrayHelper::map($res,'id_jabatan',function($model, $defaultValue) {
            return $model['nama_jabatan'];
        });
        return $list;
    }

    // mendapatkan list lokasi kerja
    public function listLokasi(){
        $res = MasterLokasi::find()->select('id_lokasi,nama_lokasi')
        ->orderBy('nama_lokasi ASC')
        ->all();
		$list = ArrayHelper::map($res,'id_lokasi',function($model, $defaultValue) {
            return $model['nama_lokasi'];
        });
        return $list;
    }

    // mendapatkan list Jam kerja
    public function listJamKerja(){
        $res = MasterJamKerja::find()->select('id_jam_kerja,nama_jam_kerja')
        ->orderBy('nama_jam_kerja ASC')
        ->all();
		$list = ArrayHelper::map($res,'id_jam_kerja',function($model, $defaultValue) {
            return $model['nama_jam_kerja'];
        });
        return $list;
    }

    // mendapatkan list group
    public function listGroup(){
        $res = MasterGroup::find()->select('id_group,nama_group')
        ->orderBy('nama_group ASC')
        ->all();
		$list = ArrayHelper::map($res,'id_group',function($model, $defaultValue) {
            return $model['nama_group'];
        });
        return $list;
    }

    // mendapatkan nama bank
    public function getNamaBank($id){
        $cek = MasterBank::find()->where(['id_bank' => $id])->one();
        if($cek){
            $nama_bank = $cek->nama_bank;
        }else{
            $nama_bank = "";
        }
        return $nama_bank;
    }

    // mendapatkan nama departemen
    public function getNamaDepartemen($id){
        $cek = MasterDepartemen::find()->where(['id_departemen' => $id])->one();
        if($cek){
            $nama_departemen = $cek->nama_departemen;
        }else{
            $nama_departemen = "";
        }
        return $nama_departemen;
    }

    // mendapatkan nama jam kerja
    public function getNamaJamKerja($id){
        $cek = MasterJamKerja::find()->where(['id_jam_kerja' => $id])->one();
        if($cek){
            $nama_jam_kerja = $cek->nama_jam_kerja;
        }else{
            $nama_jam_kerja = "";
        }
        return $nama_jam_kerja;
    }

    // mendapatkan nama status
    public function getNamaStatus($id){
        $cek = MasterStatus::find()->where(['id_status' => $id])->one();
        if($cek){
            $nama_status = $cek->nama_status;
        }else{
            $nama_status = "";
        }
        return $nama_status;
    }

    // mendapatkan nama status
    public function getNamaJabatan($id){
        $cek = MasterJabatan::find()->where(['id_jabatan' => $id])->one();
        if($cek){
            $nama_jabatan = $cek->nama_jabatan;
        }else{
            $nama_jabatan = "";
        }
        return $nama_jabatan;
    }

    // mendapatkan nama group
    public function getNamaGroup($id){
        $cek = MasterGroup::find()->where(['id_group' => $id])->one();
        if($cek){
            $nama_group = $cek->nama_group;
        }else{
            $nama_group = "";
        }
        return $nama_group;
    }

    // mendapatkan nama lokasi
    public function getNamaLokasi($id){
        $cek = MasterLokasi::find()->where(['id_lokasi' => $id])->one();
        if($cek){
            $nama_lokasi = $cek->nama_lokasi;
        }else{
            $nama_lokasi = "";
        }
        return $nama_lokasi;
    }

    // mendapatkan nama cabang
    public function getNamaCabang($id){
        $cek = MasterCabang::find()->where(['id_cabang' => $id])->one();
        if($cek){
            $nama_lokasi = $cek->nama_cabang;
        }else{
            $nama_lokasi = "";
        }
        return $nama_lokasi;
    }

    // mendapatkan nama cuti khusus
    public function getNamaCutiKhusus($id){
        $cek = MasterCutiKhusus::find()->where(['id_master_cuti_khusus' => $id])->one();
        if($cek){
            $nama_cuti = $cek->nama_cuti;
        }else{
            $nama_cuti = "";
        }
        return $nama_cuti;
    }



    // mendapatkan list Periode
    public function listPeriode(){
        $res = TransPeriode::find()->select('periode')
        ->orderBy('periode DESC')
        ->all();
		$list = ArrayHelper::map($res,'periode',function($model, $defaultValue) {
            return $model['periode'];
        });

        $a=array(Yii::$app->helperdb->periodeAktif() => Yii::$app->helperdb->periodeAktif());
        array_push($a,$list);

        return $a;
    }

    // mendapatkan list master cuti khusus
    public function listMasterCutiKhusus(){
        $res = MasterCutiKhusus::find()->select('id_master_cuti_khusus,nama_cuti,jml_hari_cuti')
        ->orderBy('id_master_cuti_khusus DESC')
        ->all();
        $list = ArrayHelper::map($res,'id_master_cuti_khusus',function($model, $defaultValue) {
            return $model['nama_cuti'].' ['.$model['jml_hari_cuti'] . '] ';
        });

        return $list;
    }
    
	public function saveLog($desc){
		//start save log
		$log = new TransLog();
		$log->desc = $desc;
		$log->userIP=Yii::$app->request->userIP;
		$log->pathInfo=Yii::$app->request->pathInfo;
		$log->port=Yii::$app->request->port;
		$log->method=Yii::$app->request->method;
		$log->userAgent=Yii::$app->request->userAgent;
		$log->save(false);
		//end save log userAgent
	}

    // mendapatkan nama karyawan
    public function getNamaKaryawan($id){
        $cek = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();
        if($cek){
            $nama_karyawan = $cek->nama_karyawan;
        }else{
            $nama_karyawan = "";
        }
        return $nama_karyawan;
    }

    // mendapatkan nama Tipe Absen
    public function getNamaTipeabsen($id){
        $cek = MasterTipeabsen::find()->where(['id_tipeabsen' => $id])->one();
        if($cek){
            $tipeabsen = $cek->tipeabsen;
        }else{
            $tipeabsen = "";
        }
        return $tipeabsen;
    }
    public function getWarnaTipeabsen($id){
        $cek = MasterTipeabsen::find()->where(['id_tipeabsen' => $id])->one();
        if($cek){
            $warna = $cek->warna;
        }else{
            $warna = "";
        }
        return $warna;
    }

    // mendapatkan nama karyawan
    public function getIdKaryawan($nik){
        $cek = MasterKaryawan::find()->where(['nik' => $nik])->one();
        if($cek){
            $id_karyawan = $cek->id_karyawan;
        }else{
            $id_karyawan = "88";
        }
        return $id_karyawan;
    }

    // mendapatkan  tabel karyawan
    public function getKaryawan($id){
        $cek = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();
        if($cek){
            return $cek;
        }else{
            return null;
        }
        
    }

    // mendapatkan  tabel Tabel Periode
    public function getTabelPeriode($id){
        $cek = TransPeriode::find()->where(['periode' => $id])->one();
        if($cek){
            return $cek;
        }else{
            return null;
        }
        
    }

    // mendapatkan Gaji Pokok
    public function getGapok($id){
        $gapok = 0;
        $cek = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();
        if($cek){
            $gapok = $cek->gapok;
        }else{
            $gapok = 0;
        }
        return $gapok;
    }

    // mendapatkan tanggal masuk karyawan
    public function gettglMasuk($id){
        $tgl_masuk = date('Y-m-d');
        $cek = MasterKaryawan::find()->where(['id_karyawan' => $id])->one();
        if($cek){
            $tgl_masuk = $cek->tgl_masuk;
        }else{
            $tgl_masuk = date('Y-m-d');
        }
        return $tgl_masuk;
    }

    // mendapatkan Gaji UMR
    public function getUmr(){
        $umr = 0;
        $cek = MasterPengaturan::find()->where(['id_pengaturan' => 1])->one();
        if($cek){
            $umr = $cek->umr;
        }else{
            $umr = 0;
        }
        return $umr;
    }

    // mendapatkan Pengaturan
    public function getPengaturan(){
        $cek = MasterPengaturan::find()->where(['id_pengaturan' => 1])->one();
        return $cek;
    }

    // mendapatkan rekap lembur periode
    public function sumLemburPeriode($periode,$id){
        $total=0;
        $query="SELECT SUM(tl.uang_lembur)AS total FROM trans_lembur tl
            WHERE tl.periode='$periode'
            AND tl.id_karyawan='$id' 
            limit 1";
        $row = Yii::$app->db->createCommand($query)->queryOne();

       if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan rekap tunjangan masa kerja
    public function sumTjMasaKerja($id){
        $total=0;
        $query="SELECT SUM(tl.nominal)AS total FROM trans_tunjangan_masa_kerja tl
                WHERE tl.aktif=1
                AND tl.id_karyawan='$id'
                limit 1";
        $row = Yii::$app->db->createCommand($query)->queryOne();

       if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan rekap tunjangan jabatan
    public function sumTjJabatan($id){
        $total=0;
        $query="SELECT SUM(tl.nominal)AS total FROM trans_tunjangan_jabatan tl
                WHERE tl.aktif=1
                AND tl.id_karyawan='$id'
                limit 1";
        $row = Yii::$app->db->createCommand($query)->queryOne();

       if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan rekap tunjangan keahlian
    public function sumTjKeahlian($id){
        $total=0;
        $query="SELECT SUM(tl.nominal)AS total FROM trans_tunjangan_keahlian tl
                WHERE tl.aktif=1
                AND tl.id_karyawan='$id' 
                limit 1";
        $row = Yii::$app->db->createCommand($query)->queryOne();

       if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan rekap tunjangan keahlian
    public function sumTjLain($periode,$id){
        $total=0;
        $query="SELECT SUM(tl.nominal)AS total FROM trans_tunjangan_lain tl
                WHERE tl.periode='$periode'
                AND tl.id_karyawan='$id'
                limit 1";
        $row = Yii::$app->db->createCommand($query)->queryOne();

       if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan rekap potongan lain
    public function sumPotLain($periode,$id){
        $total=0;
        $query="SELECT SUM(tl.nominal)AS total FROM trans_potongan_lain tl
                WHERE tl.periode='$periode'
                AND tl.id_karyawan='$id'
                limit 1";
        $row = Yii::$app->db->createCommand($query)->queryOne();

       if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan rekap potongan kedisplinan
    public function sumPotKedisplinan($periode,$id){
        $total=0;
        $query="SELECT SUM(tl.nominal)AS total FROM trans_potongan_kedisplinan tl
                WHERE tl.periode='$periode'
                AND tl.id_karyawan='$id'
                limit 1";
        $row = Yii::$app->db->createCommand($query)->queryOne();

       if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jml karyawan aktif
    public function jumlahKaryawanAktif(){
        $total=0;
        $query="SELECT COUNT(nik)AS total from master_karyawan mk
                WHERE mk.aktif=1 LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jml karyawan aktif by departemen
    public function jumlahKaryawanDepartemen($id_departemen){
        $total=0;
        $query="SELECT COUNT(nik)AS total from master_karyawan mk
                WHERE mk.aktif=1 and id_departemen='$id_departemen' LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jml karyawan aktif by departemen
    public function jumlahKaryawanJabatan($id_jabatan){
        $total=0;
        $query="SELECT COUNT(nik)AS total from master_karyawan mk
                WHERE mk.aktif=1 and id_jabatan='$id_jabatan' LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jml karyawan aktif by bank
    public function jumlahKaryawanBank($id_bank){
        $total=0;
        $query="SELECT COUNT(nik)AS total from master_karyawan mk
                WHERE mk.aktif=1 and id_bank='$id_bank' LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jml karyawan aktif by cabang
    public function jumlahKaryawanCabang($id_cabang){
        $total=0;
        $query="SELECT COUNT(nik)AS total from master_karyawan mk
                WHERE mk.aktif=1 and id_cabang='$id_cabang' LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jml karyawan aktif by umur
    public function jumlahKaryawanUmur($idfilter){
        $total=0;
        if($idfilter==1){
            $namafilter = "Umur 0-20 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 0 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <21)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 0 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <21)";
        }else if($idfilter==2){
            $namafilter = "Umur 21-30 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 20 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <31)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 20 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <31)";
        }else if($idfilter==3){
            $namafilter = "Umur 31-40 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 30 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <41)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 30 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <41)";
        }else if($idfilter==4){
            $namafilter = "Umur 41-50 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 40 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <51)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 40 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <51)";
        }else if($idfilter==5){
            $namafilter = "Umur Diatas 50 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 50 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <100)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) > 50 AND TIMESTAMPDIFF(YEAR,tgl_lahir,CURDATE()) <100)";
        }
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }


    // mendapatkan jml karyawan aktif by masa kerja
    public function jumlahKaryawanmasakerja($idfilter){
        $total=0;

        if($idfilter==0){
            $namafilter = "Masa Kerja Dibawah 1 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) < 1)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) < 1)";
        }else if($idfilter==1){
            $namafilter = "Masa Kerja 1 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) = 1)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) = 1)";
        }else if($idfilter==2){
            $namafilter = "Masa Kerja 2 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =2)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =2)";
        }else if($idfilter==3){
            $namafilter = "Masa Kerja 3 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =3)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =3)";
        }else if($idfilter==4){
            $namafilter = "Masa Kerja 4 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =4)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =4)";
        }else if($idfilter==5){
            $namafilter = "Masa Kerja 5 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =5)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =5)";
        }else if($idfilter==6){
            $namafilter = "Masa Kerja 6 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =6)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =6)";
        }else if($idfilter==7){
            $namafilter = "Masa Kerja 7 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =7)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =7)";
        }else if($idfilter==8){
            $namafilter = "Masa Kerja 8 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =8)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) =8)";
        }else if($idfilter==9){
            $namafilter = "Masa Kerja Lebih dari 8 Tahun";
            $query="SELECT
                    COUNT(id_karyawan)AS total
                    from master_karyawan
                    WHERE aktif=1
                    AND (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) >8)
                    GROUP BY (TIMESTAMPDIFF(YEAR,tgl_masuk,CURDATE()) >8)";
        }

        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jml karyawan aktif by lokasi
    public function jumlahKaryawanLokasi($id_lokasi){
        $total=0;
        $query="SELECT COUNT(nik)AS total from master_karyawan mk
                WHERE mk.aktif=1 and id_lokasi='$id_lokasi' LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jml karyawan aktif by Jenis Kelamin
    public function jumlahKaryawanJenisKelamin($id){
        $total=0;
        $query="SELECT COUNT(nik)AS total from master_karyawan mk
                WHERE mk.aktif=1 and jk='$id' LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jml karyawan aktif by Agama
    public function jumlahKaryawanAgama($id){
        $total=0;
        $query="SELECT COUNT(nik)AS total from master_karyawan mk
                WHERE mk.aktif=1 and agama='$id' LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jml karyawan aktif by group
    public function jumlahKaryawanGroup($id_group){
        $total=0;
        $query="SELECT COUNT(nik)AS total from master_karyawan mk
                WHERE mk.aktif=1 and id_group='$id_group' LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jml karyawan aktif by aktif
    public function jumlahKaryawanAktifNonaktif($id){
        $total=0;
        $query="SELECT COUNT(nik)AS total from master_karyawan mk
                WHERE mk.aktif='$id' LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jml karyawan aktif by status
    public function jumlahKaryawanStatus($id_status){
        $total=0;
        $query="SELECT COUNT(nik)AS total from master_karyawan mk
                WHERE mk.aktif=1 and id_status='$id_status' LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jumlah uang lembur per periode
    public function jumlahUangLemburPeriode($periode){
        $total=0;
        $query="SELECT SUM(uang_lembur)AS total from trans_lembur tl
                WHERE tl.periode='$periode'
                LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jumlah jam lembur per periode
    public function jumlahjamLemburPeriode($periode){
        $total=0;
        $query="SELECT SUM(jam_lembur)AS total from trans_lembur tl
                WHERE tl.periode='$periode'
                LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jumlah Gaji Bersih per periode
    public function jumlahGajiPeriode($periode){
        $total=0;
        $query="SELECT SUM(gaji_bersih)AS total from trans_gaji tg
                WHERE tg.periode='$periode'
                LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jumlah kehadiran per periode
    public function jumlahKehadiranPeriode($periode,$id){
        $total=0;
        $query="SELECT COUNT(id_absensi)AS total 
                FROM trans_absensi ta
                WHERE periode='$periode'
                AND id_karyawan='$id'
                LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan 8 Karyawan baru
    public function dataKaryawanBaru(){
        $query="SELECT mk.nik,mk.nama_karyawan, md.nama_departemen,  mk.tgl_masuk
                from master_karyawan mk
                JOIN master_departemen md ON mk.id_departemen=md.id_departemen
                WHERE mk.aktif=1 
                ORDER BY mk.id_karyawan desc
                LIMIT 8;";
        $row = Yii::$app->db->createCommand($query)->queryAll();
        return $row;
    }

    // mendapatkan 8 Karyawan resign
    public function dataKaryawanResign(){
        $query="SELECT mk.nik,mk.nama_karyawan, md.nama_departemen,  mk.tgl_masuk
                from master_karyawan mk
                JOIN master_departemen md ON mk.id_departemen=md.id_departemen
                WHERE mk.aktif=0
                ORDER BY mk.id_karyawan desc
                LIMIT 5;";
        $row = Yii::$app->db->createCommand($query)->queryAll();
        return $row;
    }

    // mendapatkan habis kontrak 30 hari
    public function dataHabisKontrak30hari(){
        $query="SELECT mk.nik,mk.nama_karyawan, mk.akhir_kontrak, 
                TIMESTAMPDIFF(DAY,curdate(),mk.akhir_kontrak) AS sisa 
                FROM master_karyawan mk
                WHERE (TIMESTAMPDIFF(DAY,curdate(),mk.akhir_kontrak)>=0 
                AND TIMESTAMPDIFF(DAY,curdate(),mk.akhir_kontrak) < 31)
                ORDER BY sisa asc
                ";
        $row = Yii::$app->db->createCommand($query)->queryAll();
        return $row;
    }

    // mendapatkan data absensi by tgl
    public function dataAbsensibyTgl($id,$tgl){
        $query="SELECT * FROM trans_absensi
                WHERE tgl_absen='$tgl'
                AND id_karyawan='$id'
                LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();
        return $row;
    }

    // mendapatkan data cuti pertahun
    public function dataCutiperTahun($id){
        $query="SELECT * FROM trans_cuti
        WHERE id_karyawan='$id'
        ;";
        $row = Yii::$app->db->createCommand($query)->queryAll();
        return $row;
    }

    // mendapatkan jml lembur by departemen
    public function jumlahLemburDepartemen($periode,$id_departemen){
        $total=0;
        $query="SELECT sum(l.uang_lembur)AS total
                FROM trans_lembur l 
                JOIN master_karyawan m ON l.id_karyawan = m.id_karyawan
                WHERE l.periode='$periode'
                AND m.id_departemen='$id_departemen'
                LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jml lembur by periode
    public function jumlahLemburPeriode(){
        $total=0;
        $query="SELECT periode,SUM(uang_lembur)AS total 
                FROM trans_gaji_history
                GROUP BY periode";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan jml lembur by status
    public function jumlahLemburStatus($periode,$id_status){
        $total=0;
        $query="SELECT sum(l.uang_lembur)AS total
                FROM trans_lembur l 
                JOIN master_karyawan m ON l.id_karyawan = m.id_karyawan
                WHERE l.periode='$periode'
                AND m.id_status='$id_status'
                LIMIT 1;";
        $row = Yii::$app->db->createCommand($query)->queryOne();

        if($row){
            $total = $row['total'];
        }else{
            $total=0;
        }
        //jika null
        if($total){
            return $total;
        }else{
            return 0;
        }
        
    }

    // mendapatkan rekap absen periode
    public function rekapAbsen($awal,$akhir,$id_karyawan){
        
        $tgl_masuk = Yii::$app->helperdb->gettglMasuk($id_karyawan);
        $periodeaktif = Yii::$app->helperdb->periodeAktif();

        $per = Yii::$app->helperdb->getTabelPeriode($periodeaktif);
        if($per){
            $awalper = $per['tgl_absen_awal'];
            $akhirper = $per['tgl_absen_akhir'];
        }else{
            $awalper = "";
            $akhirper = "";
        }

        $query = "
                SELECT '$id_karyawan'as id_karyawan, tgl,
                
                # mencari time_in
                CASE
                WHEN
                    (SELECT id_absensi_koreksi FROM trans_absensi_koreksi kor
                            WHERE kor.tgl_absen = kal.tgl AND kor.id_karyawan='$id_karyawan' LIMIT 1) != ''  
                    THEN 
                        (SELECT kor.in FROM trans_absensi_koreksi kor 
                        WHERE kor.tgl_absen = kal.tgl AND kor.id_karyawan='$id_karyawan'
                        LIMIT 1)
                ELSE 
                    (SELECT absen.IN FROM trans_absensi absen 
                    WHERE absen.tgl_absen = kal.tgl AND absen.id_karyawan='$id_karyawan'
                    LIMIT 1) 
                END AS time_in,

                # mencari time_out
                CASE
                WHEN
                    (SELECT id_absensi_koreksi FROM trans_absensi_koreksi kor
                            WHERE kor.tgl_absen = kal.tgl AND kor.id_karyawan='$id_karyawan' LIMIT 1) != ''  
                    THEN 
                        (SELECT kor.out FROM trans_absensi_koreksi kor 
                        WHERE kor.tgl_absen = kal.tgl AND kor.id_karyawan='$id_karyawan'
                        LIMIT 1)
                ELSE 
                    (SELECT absen.`out` FROM trans_absensi absen 
                    WHERE absen.tgl_absen = kal.tgl AND absen.id_karyawan='$id_karyawan'
                    LIMIT 1) 
                END AS time_out,

                # mencari status
                CASE
                WHEN
                    kal.tgl < '$tgl_masuk'
                    THEN '8'
                WHEN
                    kal.tgl > '$akhirper'
                    THEN '8'
                WHEN
                    (SELECT id_absensi_koreksi FROM trans_absensi_koreksi kor
                            WHERE kor.tgl_absen = kal.tgl AND kor.id_karyawan='$id_karyawan' LIMIT 1) != ''  
                    THEN '2'
                WHEN
                    (SELECT id_off FROM trans_off moff
                            WHERE moff.tgl = kal.tgl AND moff.id_karyawan='$id_karyawan' LIMIT 1) != ''  
                    THEN '8'
                WHEN
                    (SELECT id_cuti FROM trans_cuti cuti
                            WHERE cuti.tgl_awal = kal.tgl AND cuti.id_karyawan='$id_karyawan' LIMIT 1) != '' 
                    THEN '4'
                WHEN
                    (SELECT id_cuti_khusus FROM trans_cuti_khusus cuti
                            WHERE cuti.tgl_awal = kal.tgl AND cuti.id_karyawan='$id_karyawan' LIMIT 1) != '' 
                    THEN '5'
                WHEN 
                    (SELECT id_sakit FROM trans_sakit sakit
                        WHERE sakit.tgl = kal.tgl AND sakit.id_karyawan='$id_karyawan' LIMIT 1) != '' 
                    THEN '3'	 
                WHEN 
                        (SELECT absen.IN FROM trans_absensi absen 
                        WHERE absen.tgl_absen = kal.tgl AND absen.id_karyawan='$id_karyawan'
                        LIMIT 1) != '' and (SELECT absen.`out` FROM trans_absensi absen 
                        WHERE absen.tgl_absen = kal.tgl AND absen.id_karyawan='$id_karyawan'
                        LIMIT 1) != '' 
                    THEN '2' 
                WHEN
                    (SELECT id_libur FROM trans_libur libur
                        WHERE libur.tgl = kal.tgl) != ''
                    THEN '7'
                WHEN DAYOFWEEK(kal.tgl)=1 THEN '6'
                WHEN DAYOFWEEK(kal.tgl)=7 THEN '6'
                    ELSE '1'
                END AS status,

                (SELECT id_jam_kerja FROM master_karyawan
                 WHERE id_karyawan='$id_karyawan') AS jamkerja
                
            FROM master_kalender kal
            WHERE kal.tgl BETWEEN '$awal' AND '$akhir'        
                "; 
        

        $row = Yii::$app->db->createCommand($query)->queryAll();

        return $row;       
    }

    // mendapatkan rekap absen periode
    public function rekapAbsenPeriode($awal,$akhir,$id_karyawan){

        $tgl_masuk = Yii::$app->helperdb->gettglMasuk($id_karyawan);
        $periodeaktif = Yii::$app->helperdb->periodeAktif();

        $per = Yii::$app->helperdb->getTabelPeriode($periodeaktif);
        if($per){
            $awalper = $per['tgl_absen_awal'];
            $akhirper = $per['tgl_absen_akhir'];
        }else{
            $awalper = "";
            $akhirper = "";
        }


        $query = "
        SELECT a.status as status,COUNT(a.id_karyawan)as jml FROM
                (SELECT '$id_karyawan'as id_karyawan, tgl,

                # mencari time_in
                (SELECT absen.IN FROM trans_absensi absen 
                WHERE absen.tgl_absen = kal.tgl AND absen.id_karyawan='$id_karyawan'
                LIMIT 1) AS time_in, 

                # mencari time_out
                (SELECT absen.`out` FROM trans_absensi absen 
                WHERE absen.tgl_absen = kal.tgl AND absen.id_karyawan='$id_karyawan'
                LIMIT 1) AS time_out,

                # mencari status
                CASE
                WHEN
                    kal.tgl < '$tgl_masuk'
                    THEN '8'
                WHEN
                    kal.tgl > '$akhirper'
                    THEN '8'
                WHEN
                    (SELECT id_absensi_koreksi FROM trans_absensi_koreksi kor
                            WHERE kor.tgl_absen = kal.tgl AND kor.id_karyawan='$id_karyawan' LIMIT 1) != ''  
                    THEN '2'
                WHEN
                    (SELECT id_off FROM trans_off moff
                            WHERE moff.tgl = kal.tgl AND moff.id_karyawan='$id_karyawan' LIMIT 1) != ''  
                    THEN '8'
                WHEN
                    (SELECT id_cuti FROM trans_cuti cuti
                            WHERE cuti.tgl_awal = kal.tgl AND cuti.id_karyawan='$id_karyawan' LIMIT 1) != '' 
                    THEN '4'
                WHEN
                    (SELECT id_cuti_khusus FROM trans_cuti_khusus cuti
                            WHERE cuti.tgl_awal = kal.tgl AND cuti.id_karyawan='$id_karyawan' LIMIT 1) != '' 
                    THEN '5'
                WHEN 
                    (SELECT id_sakit FROM trans_sakit sakit
                        WHERE sakit.tgl = kal.tgl AND sakit.id_karyawan='$id_karyawan' LIMIT 1) != '' 
                    THEN '3'	 
                WHEN 
                        (SELECT absen.IN FROM trans_absensi absen 
                        WHERE absen.tgl_absen = kal.tgl AND absen.id_karyawan='$id_karyawan'
                        LIMIT 1) != '' and (SELECT absen.`out` FROM trans_absensi absen 
                        WHERE absen.tgl_absen = kal.tgl AND absen.id_karyawan='$id_karyawan'
                        LIMIT 1) != '' 
                    THEN '2' 
                WHEN
                    (SELECT id_libur FROM trans_libur libur
                        WHERE libur.tgl = kal.tgl) != ''
                    THEN '7'
                WHEN DAYOFWEEK(kal.tgl)=1 THEN '6'
                WHEN DAYOFWEEK(kal.tgl)=7 THEN '6'
                    ELSE '1'
                END AS status
                
            FROM master_kalender kal
            WHERE kal.tgl BETWEEN '$awal' AND '$akhir')
        AS a
        GROUP BY a.status       
                ";
        $row = Yii::$app->db->createCommand($query)->queryAll();

        return $row;
        
    }

    // mendapatkan data cuti pertahun
    public function jumlahRekapAbsen($awal,$akhir,$id_karyawan,$tipeabsen){

        $tgl_masuk = Yii::$app->helperdb->gettglMasuk($id_karyawan);
        $periodeaktif = Yii::$app->helperdb->periodeAktif();

        $per = Yii::$app->helperdb->getTabelPeriode($periodeaktif);
        if($per){
            $awalper = $per['tgl_absen_awal'];
            $akhirper = $per['tgl_absen_akhir'];
        }else{
            $awalper = "";
            $akhirper = "";
        }
        $query = "
            SELECT  COUNT(a.idk)as jml FROM

            # mencari time_in
            (SELECT $id_karyawan AS idk,tgl,

            # mencari status
            CASE
            WHEN
                kal.tgl < '$tgl_masuk'
                THEN '8'
            WHEN
                kal.tgl > '$akhirper'
                THEN '8'
            WHEN
                (SELECT id_absensi_koreksi FROM trans_absensi_koreksi kor
                        WHERE kor.tgl_absen = kal.tgl AND kor.id_karyawan='$id_karyawan' LIMIT 1) != ''  
                THEN '2'
            WHEN
                (SELECT id_off FROM trans_off moff
                        WHERE moff.tgl = kal.tgl AND moff.id_karyawan='$id_karyawan' LIMIT 1) != ''  
                THEN '8'
            WHEN
                (SELECT id_cuti FROM trans_cuti cuti
                        WHERE cuti.tgl_awal = kal.tgl AND cuti.id_karyawan='$id_karyawan' LIMIT 1) != '' 
                THEN '4'
            WHEN
                (SELECT id_cuti_khusus FROM trans_cuti_khusus cuti
                        WHERE cuti.tgl_awal = kal.tgl AND cuti.id_karyawan='$id_karyawan' LIMIT 1) != '' 
                THEN '5'
            WHEN 
                (SELECT id_sakit FROM trans_sakit sakit
                    WHERE sakit.tgl = kal.tgl AND sakit.id_karyawan='$id_karyawan' LIMIT 1) != '' 
                THEN '3'	 
            WHEN 
                    (SELECT absen.IN FROM trans_absensi absen 
                    WHERE absen.tgl_absen = kal.tgl AND absen.id_karyawan='$id_karyawan'
                    LIMIT 1) != '' and (SELECT absen.`out` FROM trans_absensi absen 
                    WHERE absen.tgl_absen = kal.tgl AND absen.id_karyawan='$id_karyawan'
                    LIMIT 1) != '' 
                THEN '2' 
            WHEN
                (SELECT id_libur FROM trans_libur libur
                    WHERE libur.tgl = kal.tgl) != ''
                THEN '7'
            WHEN DAYOFWEEK(kal.tgl)=1 THEN '6'
            WHEN DAYOFWEEK(kal.tgl)=7 THEN '6'
                ELSE '1'
            END AS status
            
            FROM master_kalender kal
            WHERE kal.tgl BETWEEN '$awal' AND '$akhir')
            AS a
            WHERE a.STATUS=$tipeabsen
            GROUP BY a.status 
            LIMIT 1      
        ";

        $row = Yii::$app->db->createCommand($query)->queryOne();
        
        $jml=0;
        if($row){
            $jml = $row['jml'];
        }else{
            $jml = 0;
        }

        return $jml;


    }

    // mendapatkan rekap absen karyawan per tipe absen
    public function jumlahRekapAbsenKaryawan($awal,$akhir,$tipeabsen){
        $model = MasterKaryawan::find()
        ->where(['aktif' => 1])
        ->orderBy(['nama_karyawan' => SORT_ASC])
        ->all(); 
        $total = 0;
        foreach($model as $row){
            $id_karyawan = $row->id_karyawan;
            $data = Yii::$app->helperdb->jumlahRekapAbsen($awal,$akhir,$id_karyawan,$tipeabsen);
            if($data){
                $total = $total + $data;
            }else{
                $total = $total + 0;
            }
        } 
        return $total;       
    }


    //ERP

    // mendapatkan nama user
    public function getField($table,$field_id,$field_name,$field_id_value){
        $query = "
                    select $field_name from $table where $field_id = '$field_id_value' limit 1
                ";
        $row = Yii::$app->db->createCommand($query)->queryOne();
        $result = "";
        if($row){
            $result = $row[$field_name];
        }

        return $result;
    }



    // mendapatkan list product category aktif 
    public function listProductCategory(){
        $kar = MasterProductCategory::find()->select('id_product_category,product_category')
        ->where(['aktif' => 1])
        ->orderBy('product_category ASC')
        ->all();
		$list = ArrayHelper::map($kar,'id_product_category',function($model, $defaultValue) {
            return $model['product_category'].' ['.$model['id_product_category'] . '] ';
        });
        return $list;
    }

    // mendapatkan customer 
    public function listCustomer(){
        $kar = MasterCustomer::find()->select('id_customer,kode_customer,nama_customer')
        ->where(['aktif' => 1])
        ->orderBy('nama_customer ASC')
        ->all();
		$list = ArrayHelper::map($kar,'id_customer',function($model, $defaultValue) {
            return $model['nama_customer'];
        });
        return $list;
    }

    // mendapatkan getProductCategoryName
    public function getProductCategoryName($id){
        $r = MasterProductCategory::find()->where(['id_product_category' => $id])->one();
        if($r){
            $result = $r->product_category;
        }else{
            $result = "";
        }
        return $result;
    }

    // mendapatkan autonumber kode_product
    public function auto_kode_product($id_product_category){
        $kode="";
        $year = date("Y");

        $cek = MasterProduct::find()
        ->andWhere(['YEAR(created_at)' => $year])
        ->orderBy(new \yii\db\Expression('SUBSTRING(kode_product, -4) DESC'))
        ->one();

        if($cek){
            $no = str_pad(substr($cek->kode_product,-4)+1, 4, '0', STR_PAD_LEFT);
        }else{
            $no = str_pad(1, 4, '0', STR_PAD_LEFT);
        }

        $kode = "P".$id_product_category . date('ym') . $no;

        return $kode;
     }

     // mendapatkan autonumber kode_customer
    public function auto_kode_customer(){
        $kode="";
        $year = date("Y");

        $cek = MasterCustomer::find()
        ->andWhere(['YEAR(created_at)' => $year])
        ->orderBy(new \yii\db\Expression('SUBSTRING(kode_customer, -4) DESC'))
        ->one();

        if($cek){
            $no = str_pad(substr($cek->kode_customer,-4)+1, 4, '0', STR_PAD_LEFT);
        }else{
            $no = str_pad(1, 4, '0', STR_PAD_LEFT);
        }

        $kode = "C". date('ym') . $no;

        return $kode;
     }

    // mendapatkan autonumber kode_vendor
    public function auto_kode_vendor(){
        $kode="";
        $year = date("Y");

        $cek = MasterVendor::find()
        ->andWhere(['YEAR(created_at)' => $year])
        ->orderBy(new \yii\db\Expression('SUBSTRING(kode_vendor, -4) DESC'))
        ->one();

        if($cek){
            $no = str_pad(substr($cek->kode_vendor,-4)+1, 4, '0', STR_PAD_LEFT);
        }else{
            $no = str_pad(1, 4, '0', STR_PAD_LEFT);
        }

        $kode = "V". date('ym') . $no;

        return $kode;
     }

     // mendapatkan autonumber kode_sales_order
    public function auto_kode_sales_order(){
        $kode="";
        $year = date("Y");

        $cek = TransSalesOrderHeader::find()
        ->andWhere(['YEAR(created_at)' => $year])
        ->orderBy(new \yii\db\Expression('SUBSTRING(kode_sales_order, -5) DESC'))
        ->one();

        if($cek){
            $no = str_pad(substr($cek->kode_sales_order,-5)+1, 5, '0', STR_PAD_LEFT);
        }else{
            $no = str_pad(1, 5, '0', STR_PAD_LEFT);
        }

        $kode = "SO". date('ym') . $no;

        return $kode;
     }

     // mendapatkan aktif
    public function getStatus($id){
        $r = "";
        if($id==0){
            $r = "OPEN";
        }else if($id==1){
            $r = "COMPLETE";
        }else if($id==2){
            $r = "VOID";
        }
        return $r;
     }

     public function getStatusColor($id){
        $r = "";
        if($id==0){
            $r = "#FFFACD";
        }else if($id==1){
            $r = "";
        }else if($id==2){
            $r = "#F98B88";
        }
        return $r;
     }


			
}