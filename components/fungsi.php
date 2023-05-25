<?php
namespace app\components;
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\administrator\TransLog;

class Fungsi extends Component
{

 	public function Pembilang($x){
		$abil = array(
			"", 
			"Satu", "Dua", "Tiga", 
			"Empat", "Lima", "Enam", 
			"Tujuh", "Delapan", "Sembilan", 
			"Sepuluh", "Sebelas"
		);
	
		if ($x < 12) 
		 return " ".$abil[$x];
		elseif ($x<20) 
		 return $this->pembilang($x-10)." Belas";
		elseif ($x<100) 
		 return $this->pembilang($x/10)." Puluh".$this->pembilang($x%10);
		elseif ($x<200) 
		 return " Seratus".$this->pembilang($x-100);
		elseif ($x<1000) 
		 return $this->pembilang($x/100)." Ratus".$this->pembilang($x%100);
		elseif ($x<2000) 
		 return " Seribu".$this->pembilang($x-1000);
		elseif ($x<1000000) 	
		 return $this->pembilang($x/1000)." Ribu".$this->pembilang($x%1000);
		elseif ($x<1000000000) 
		 return $this->pembilang($x/1000000)." Juta".$this->pembilang($x%1000000);
		elseif ($x<1000000000000) 
		 return $this->pembilang($x/1000000000)." Milyar".$this->pembilang($x-(floor($x/1000000000)*1000000000));
		elseif ($x<1000000000000000) 
		 return $this->pembilang($x/1000000000000)." Trilyun".$this->pembilang($x%1000000000000);   
		
	}
	
	public function Pembilangkoma($x){
	  $str = stristr($x,",");
	  $ex = explode(',',$x);
	   
	  if(($ex[1]/10) >= 1){
		$a = abs($ex[1]);
	  }

	  $string = array("Nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan","sepuluh", "sebelas");
	  $temp = "";
	  
	  $a2 = $ex[1]/10;
	  $pjg = strlen($str);
	  $i =1;
		 
	   
	  if(isset($a) && $a>=1 && $a< 12){   
		$temp .= " ".$string[$a];
	  }else if(isset($a) && $a>12 && $a < 20){   
	   	$temp .= $this->pembilang($a - 10)." Belas";
	  }else if (isset($a) && $a>20 && $a<100){   
	   	$temp .= $this->pembilang($a / 10)." Puluh". $this->pembilang($a % 10);
	  }else{
	   	if($a2<1){
			while ($i<$pjg){     
			$char = substr($str,$i,1);     
			$i++;
			$temp .= " ".$string[$char];
		}

	   }
	  }  
	  return $temp;
	}
	  
	public function Terbilang($x){
		if($x<0){
			$hasil = "minus ".trim($this->pembilang(x));
		}else{
			$poin = trim($this->pembilangkoma($x));
			$hasil = trim($this->pembilang($x));
		}
		
		if($poin){
			$hasil = $hasil." Koma ".$poin;
		}else{
			$hasil = $hasil;
		}

		return $hasil;  
	}

	public function getHari($x){
		$hari="";
		if($x==1){
			$hari = "Minggu";
		}else if($x==2){
			$hari = "Senin";
		}else if($x==3){
			$hari = "Selasa";
		}else if($x==4){
			$hari = "Rabu";
		}else if($x==5){
			$hari = "Kamis";
		}else if($x==6){
			$hari = "Jumat";
		}else if($x==7){
			$hari = "Sabtu";
		}else{
			$hari = "";
		}
		return $hari;  
	}
	
	public function TanggalIndo($date){
		 if($date==""){
			 $result = "";
		 }else{
			 $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);
	 
		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;	
		 }
			
		return($result);
	}
	
	
	public function Bulanromawi($x){
		if ($x == '01') 
		 return "I";
		elseif ($x == '02') 
		 return "II";
		elseif ($x == '03') 
		 return "III";
		elseif ($x == '04') 
		 return "IV";
		elseif ($x == '05') 
		 return "V";
		elseif ($x == '06') 
		 return "VI";
		elseif ($x == '07') 	
		 return "VII";
		elseif ($x == '08') 
		 return "VIII";
		elseif ($x == '09') 
		 return "IX";
		elseif ($x == '10')  
		 return "X";   
		elseif ($x == '11')  
		return "XI";
		elseif ($x == '12')  
		return "XII";
	}
	
	public function Cekromawi($x){
		if ($x == 'I') 
		 return "01";
		elseif ($x == 'II') 
		 return "02";
		elseif ($x == 'III') 
		 return "03";
		elseif ($x == 'IV') 
		 return "04";
		elseif ($x == 'V') 
		 return "05";
		elseif ($x == 'VI') 
		 return "06";
		elseif ($x == 'VII') 	
		 return "07";
		elseif ($x == 'VIII') 
		 return "08";
		elseif ($x == 'IX') 
		 return "09";
		elseif ($x == 'X')  
		 return "10";   
		elseif ($x == 'XI')  
		return "11";
		elseif ($x == 'XII')  
		return "12";
	}

	public function getRomawi($bln){
		switch ($bln){
			case 1: 
				return "I";
				break;
			case 2:
				return "II";
				break;
			case 3:
				return "III";
				break;
			case 4:
				return "IV";
				break;
			case 5:
				return "V";
				break;
			case 6:
				return "VI";
				break;
			case 7:
				return "VII";
				break;
			case 8:
				return "VIII";
				break;
			case 9:
				return "IX";
				break;
			case 10:
				return "X";
				break;
			case 11:
				return "XI";
				break;
			case 12:
				return "XII";
				break;
		}
	}

	public function getTglAkhirBulan($bulan){
		//hasil 28,29,30,31
		$akhir_bulan = 30;
		$tahun = date('Y');
	    if($bulan=='4' || $bulan=='6' || $bulan=='9' || $bulan=='11'){
			$akhir_bulan = '30';
		}else if($bulan=='1' || $bulan=='3' || $bulan=='5' || $bulan=='7' || $bulan=='8' || $bulan=='10' || $bulan=='12'){
			$akhir_bulan = '31';
		}else if($bulan=='2'){
			if ($tahun%4==0){
				$akhir_bulan = '29';
			}else if($tahun%4!=0){
				$akhir_bulan = '28';
			}  
		}else{
			$akhir_bulan = '30';
		}	  
		return $akhir_bulan; 
	}

	public function cariPeriode($periode){
		//hasil 2021-04
		$periodelalu = '';
		$periodedepan = '';
		$tahun = substr($periode,0,4);
		$bulan = substr($periode,5,2);

		if($bulan=='1'){
		   $periodelalu = ($tahun-1) . '-12';
		   $periodedepan = $tahun . '-02';
		}else if($bulan=='12'){
		   $periodelalu = $tahun . '-11';
		   $periodedepan = ($tahun+1) . '-01';
		}else{
		   $periodelalu = $tahun . '-' .  str_pad(($bulan-1), 2, "0", STR_PAD_LEFT);  
		   $periodedepan = $tahun . '-' . str_pad(($bulan+1), 2, "0", STR_PAD_LEFT); 
		}

		$data = [
			'periodelalu'=> $periodelalu,
			'periodedepan'=> $periodedepan,
		];
		return $data;
	}

	public function cariPeriodeByTgl($tgl){
		$tahun = substr($tgl,0,4);
		$bulan = substr($tgl,5,2);
		$tgl = substr($tgl,8,2);

		if($bulan=='1'){
			if($tgl>=16){
				// 2021-01-16 = 2021-02
				$periode = $tahun . "-" . str_pad(($bulan+1), 2, "0", STR_PAD_LEFT);
			}else{
				// 2021-01-01 = 2021-01
				$periode = $tahun . "-" . str_pad(($bulan), 2, "0", STR_PAD_LEFT);
			}
		}else if($bulan=='12'){
			if($tgl>=16){
				// 2021-12-16 = 2022-01
				$periode = $tahun+1 . "-" . str_pad((1), 2, "0", STR_PAD_LEFT);
			}else{
				// 2021-12-01 = 2021-12
				$periode = $tahun . "-" . str_pad(($bulan), 2, "0", STR_PAD_LEFT);
			}
		}else{
		   if($tgl>=16){
			   // 2021-05-16 = 2021-06
			   $periode = $tahun . "-" . str_pad(($bulan+1), 2, "0", STR_PAD_LEFT);
		   }else{
			   // 2021-05-01 = 2021-05
		       $periode = $tahun . "-" . str_pad(($bulan), 2, "0", STR_PAD_LEFT);
		   }
		}

		return $periode;
	}

	public function cariBulan($periode){
		//hasil 01,02
		$bulanlalu = '';
		$bulandepan = '';
		$tahun = substr($periode,0,4);
		$bulan = substr($periode,5,2);

		if($bulan=='1'){
		   $bulanlalu = '12';
		   $bulandepan = '2';
		}else if($bulan=='12'){
		   $bulanlalu = '11';
		   $bulandepan = '1';
		}else{
		   $bulanlalu = $bulan-1;
		   $bulandepan = $bulan+1;
		}

		$data = [
			'bulanlalu'=> $bulanlalu,
			'bulandepan'=> $bulandepan,
		];
		return $data; 
	}

	public function durasiJam($jam_mulai,$jam_akhir){
		$jam = 0;
		$diff     = strtotime($jam_akhir) - strtotime($jam_mulai);
		$menit    = round($diff/60,0);
		$jam      = round($menit/60,2);
		return $jam; 
	}

	public function durasiMenit($jam_mulai,$jam_akhir){
		$menit = 0;
		$diff     = strtotime($jam_akhir) - strtotime($jam_mulai);
		$menit    = round($diff/60,0);
		return $menit; 
	}

	public function indexLembur($jh,$jam){
		$index_lembur = 0;
		if($jh=="L"){
			if($jam==0){
				$index_lembur = 0;
			}else{
				$index_lembur = round((2 * $jam),2);
			}
		 }else{
			if($jam==0){
				$index_lembur = 0;
			}else if($jam<=1){
				$index_lembur = round(1.5 * $jam,2);
			}else{
				$index_lembur = round((2 * $jam)-0.5,2);
			}
		 }
		return $index_lembur; 
	}

	//menampilkan jenis kelamin
	public function namaJk($kode){
		$nama="";
		if($kode=="1"){
			$nama="Laki-Laki";
		}else if($kode=="0"){
			$nama="Perempuan";
		}
		return $nama; 
	}

	//menampilkan status menikah
	public function namaStatusMenikah($kode){
		$nama="";
		if($kode=="1"){
			$nama="Menikah";
		}else if($kode=="0"){
			$nama="Lajang";
		}
		return $nama; 
	}

	//menampilkan Hari
	public function namaHari($kode){
		$nama="";
		if($kode=="1"){
			$nama="Minggu";
		}else if($kode=="2"){
			$nama="Senin";
		}else if($kode=="3"){
			$nama="Selasa";
		}else if($kode=="4"){
			$nama="Rabu";
		}else if($kode=="5"){
			$nama="Kamis";
		}else if($kode=="6"){
			$nama="Jumat";
		}else if($kode=="7"){
			$nama="Sabtu";
		}
		return $nama; 
	}
					
}