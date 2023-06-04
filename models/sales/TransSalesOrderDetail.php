<?php

namespace app\models\sales;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

class TransSalesOrderDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_sales_order_detail';
    }

    public function behaviors(){ 
        return [        
            [            
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),        
            ], 
            [            
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by'       
            ],   
        ];   
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by', 'id_product'], 'integer'],
            [['id_product', 'qty', 'price'], 'required'],
            [['qty'], 'number'],
            [['price'], 'double'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sales_order_detail' => 'id_sales_order_detail',
        ];
    }
}
