<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

$this->title = 'Gaji Pokok';
$this->params['breadcrumbs'][] = $this->title;

$js = <<<js
	$('#mytable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      "lengthMenu": [ [10, 25, 50, 100, 500, 100, -1],[10, 25, 50, 100, 500, 1000, "All"] ],
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
    
    
    <div class="col-md-2 col-sm-6 col-xs-12">
        <?php 
            $a=array("ALL"=>"ALL");
            array_push($a,$listDepartemen);
            echo Select2::widget([
                'name' => 'id_departemen',
                'data' => $a,
                'value'=> "ALL",
                'options' => [
                    'placeholder' => 'Departemen',
                ],
            ]);
        ?>
    </div>

  
        <?= Html::submitButton('Filter', ['class' => 'btn btn-default','name'=>'tombol','value'=>'filter']); ?>
        <?= Html::submitButton('Excel', ['class' => 'btn btn-default','name'=>'tombol','value'=>'excel']); ?>	
        <?= Html::submitButton('Pdf', ['class' => 'btn btn-default','name'=>'tombol','value'=>'pdf']); ?>
    

      <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
      </div>
    </div>
    <div class="box-body">
        <table class='table table-striped table-hover table-bordered' id='mytable'>
        <thead>
            <tr>
            <th width="5%" align="center">Menu</th>
            <th width="5%" align="center">No</th>
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
                <td align="center">
                    <?=Html::a("...", ['view', 'id' => $row->id_karyawan], ['class' => 'btn btn-primary btn-xs','data-toggle'=>"modal",
                                'data-target'=>"#myModal",])?>
                </td>
                <td align="center"><?=$no?></td>
                <td><?=$row->nik?></td>
                <td><?=$row->nama_karyawan ?></td>
                <td><?=Yii::$app->helperdb->getNamaDepartemen($row->id_departemen)?></td>
                <td><?=number_format($row->gapok,0) ?></td>
                <td><?=$diatas ?></td>
                
            </tr>
        <?php $no++; } ?>
        </tbody>
        </table>
    </div>
</div>
<?php ActiveForm::end(); ?>

<?php
    Modal::begin([
        'id' => 'myModal',
    ]);
        Pjax::begin([
            'id'=>'pjax-modal','timeout'=>false,
            'enablePushState'=>false,
            'enableReplaceState'=>false,
        ]);
        Pjax::end();
    Modal::end();
?>



