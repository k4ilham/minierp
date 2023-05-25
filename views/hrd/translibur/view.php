<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransLembur */

$this->title = "Hari Libur Nasional";
$this->params['breadcrumbs'][] = ['label' => 'Trans Lemburs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$periodeaktif = Yii::$app->helperdb->periodeAktif();

?>
<div class="trans-lembur-view">


<table class='table table-striped table-hover table-bordered' id='mytable2'>
    <thead>
    </thead>
    <tbody>
        <tr><td width="30%">Tgl</td><td width="1%">:</td><td><?=$model->tgl?></td></tr>
        
    </tbody>
</table>
<hr>


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_libur], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_libur], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


</div>
