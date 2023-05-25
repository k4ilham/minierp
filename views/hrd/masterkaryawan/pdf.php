<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    //header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    //header("Content-Disposition: attachment; filename=Report_karyawan.xls");
    $post = Yii::$app->request->post();

    $id_departemen = $post['id_departemen'];
    $id_status = $post['id_status'];
    $id_jabatan = $post['id_jabatan'];
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
		<td width="75%" align="center" colspan="2" style="font-size:20px;font-weight: bold;">KARYAWAN</td>
	</tr>
	<tr>
		<td width="20%">Departemen</td>
		<td colspan="2"><?=Yii::$app->helperdb->getNamaDepartemen($id_departemen)?></td>
	</tr>
	<tr>
		<td width="20%">Status</td>
		<td colspan="2"><?=Yii::$app->helperdb->getNamaStatus($id_status)?></td>
	</tr>
	<tr>
		<td width="20%">Jabatan</td>
		<td colspan="2"><?=Yii::$app->helperdb->getNamaJabatan($id_jabatan)?></td>

		</td>
	</tr>
</table>

<table border="1" width="100%" cellspacing="2" cellpadding="2" style="border-collapse: collapse;">
    <thead>
        <tr>
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