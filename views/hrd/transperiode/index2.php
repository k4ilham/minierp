<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\hrd\TransperiodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Periode';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transperiode-index">



    <p>
        <?= Html::a('Tambah periode', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_periode',
            'periode',
            'aktif',
            'tgl_gaji',
            'tgl_absen_awal',
            'tgl_absen_akhir',
            'tgl_posting',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
