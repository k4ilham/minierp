<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=gaji_pokok.xls");
    $post = Yii::$app->request->post();
    $id_departemen = $post['id_departemen'];

?>
<table border="0" width="100%" cellspacing="4" cellpadding="4" style="border-collapse: collapse;">
	<tr>
		<td align="right" width="100%">
           Report Date : <?=date('d-M-Y')?>
		</td>
	</tr>
</table>
<table border="1" width="100%" cellspacing="4" cellpadding="4" style="border-collapse: collapse;">
	<tr>
		<td align="center" width="25%">
			<img src="<?php echo Url::base(); ?>/file/logoijms.png" width="125px" height="auto">
		</td>
		<td width="75%" align="center" colspan="2" style="font-size:20px;font-weight: bold;">GAJI POKOK</td>
	</tr>
	<tr>
		<td width="20%">Departemen</td>
		<td colspan="2"><?=Yii::$app->helperdb->getNamaDepartemen($id_departemen)?></td>
	</tr>
</table>

<table class='table table-striped table-hover table-bordered' id='mytable'>
    <thead>
        <tr>
        <th width="10%" align="center">No</th>
        <th align="center">NIK</th>
        <th align="center">Nama Lengkap</th>
        <th align="center">Departemen</th>
        <th align="center">Gaji Pokok</th>
        <th align="center">UMR</th>
        
        </tr>
    </thead>
    <tbody>
    <?php 
    $no=1;
    foreach($model as $row){ 
        $diatas="-";
        if($row->gapok == 0){
            $diatas = "-";
        }else if($row->gapok == Yii::$app->helperdb->getUmr()){
            $diatas = "UMR";
        }else if($row->gapok > Yii::$app->helperdb->getUmr()){
            $diatas = "Diatas UMR";
        }else if($row->gapok < Yii::$app->helperdb->getUmr()){
            $diatas = "Dibawah UMR"; 
        }

        ?>
        <tr>
            <td align="center"><?=$no?></td>
            <td><?=$row->nik?></td>
            <td><?=$row->nama_karyawan ?></td>
            <td><?=Yii::$app->helperdb->getNamaDepartemen($row->id_departemen)?></td>
            <td><?=number_format($row->gapok,0,',','.') ?></td>
            <td><?=$diatas ?></td>
            
        </tr>
    <?php $no++; } ?>
    </tbody>
</table>