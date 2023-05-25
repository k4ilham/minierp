<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\hrd\TransUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Trans Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trans-user-view">

<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_departemen',
            'username',
        ],
    ]) ?>


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Yakin mau hapus user?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Reset Password', ['resetpass', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Yakin Mau reset password?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
