<?php
use \yii\helpers\Url;
use \yii\helpers\Html;


// URL ke home atau web index
echo Url::home(); echo '<br>';

// URL ke current Controller
echo Url::to(); echo '<br>';

// URL ke current Controller pada Action create
echo Url::to(['create']); echo '<br>';

// URL ke person Controller pada Action index
echo Url::to(['person/index']); echo '<br>';

// URL ke current Controller pada Action index
// dengan parameter nama yang bernilai Hafid
echo Url::to(['person/index','nama'=>'Hafid']);



echo Html::a('Example','http://www.example.com');
echo "<br>";
echo Html::a('Data Person',['person/index']);