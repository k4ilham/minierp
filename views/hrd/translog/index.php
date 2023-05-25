<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\hrd\TranslogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Translogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="translog-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_log',
            'timelog',
            'desc',
            'id_user',
            'userIP',
            //'scriptUrl',
            //'scriptFile',
            //'pathInfo',
            //'port',
            //'method',
            //'origin',
            //'userAgent:ntext',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
