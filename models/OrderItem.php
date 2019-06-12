<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "OrderItem".
 *
 * @property int $ID
 * @property int $ProductID
 * @property int $OrderID
 *
 * @property Order $order
 * @property Product $product
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'OrderItem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ProductID', 'OrderID'], 'integer'],
            [['OrderID'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['OrderID' => 'ID']],
            [['ProductID'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['ProductID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ProductID' => 'Product ID',
            'OrderID' => 'Order ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['ID' => 'OrderID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['ID' => 'ProductID']);
    }
}
