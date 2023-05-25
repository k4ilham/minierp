<?php

namespace app\models\sales;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

class TransSalesOrderHeader extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_sales_order_header';
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
            [['created_by', 'updated_by','id_customer','id_customer_sell_to','id_customer_bill_to','sales_person_code'], 'integer'],
            [['created_at', 'updated_at','document_date','posting_date'], 'safe'],
            [['description','order_date','ext_doc_no','ship_to_name','ship_to_address'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sales_order_header' => 'id_sales_order_header',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
